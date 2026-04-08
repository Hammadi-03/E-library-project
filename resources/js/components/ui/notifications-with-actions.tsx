"use client";

import * as React from "react"
import { Bell, GripVertical, Trash2, Archive, ChevronRight } from "lucide-react"
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from "@/components/ui/popover"
import { Card } from "@/components/ui/card"
import { Badge } from "@/components/ui/badge"
import { motion } from "framer-motion"

interface NotificationItem {
  id: string
  title: string
  description: string
  time: string
}

interface NotificationsWithActionsProps {
  items?: NotificationItem[]
  placement?: "top" | "right" | "bottom" | "left"
}

const defaultNotifications: NotificationItem[] = [
  {
    id: "1",
    title: "Welcome 🎉",
    description: "Thanks for checking out the notifications component!",
    time: "just now",
  },
  {
    id: "2",
    title: "System Update",
    description: "We’ve rolled out a new feature for you.",
    time: "1h ago",
  },
  {
    id: "3",
    title: "Reminder",
    description: "Don’t forget to finish your profile setup.",
    time: "3h ago",
  },
]

export default function NotificationsWithActions({
  items = defaultNotifications,
  placement = "bottom",
}: NotificationsWithActionsProps) {
  const [notifications, setNotifications] =
    React.useState<NotificationItem[]>(items)
  const [activeId, setActiveId] = React.useState<string | null>(null)

  React.useEffect(() => {
    // Poll for new notifications every 10 seconds
    const fetchNotifications = async () => {
      try {
        const response = await fetch('/api/user/notifications');
        if (response.ok) {
          const data = await response.json();
          setNotifications(data);
        }
      } catch (error) {
        console.error('Failed to fetch notifications', error);
      }
    };

    const interval = setInterval(fetchNotifications, 10000);
    return () => clearInterval(interval);
  }, []);

  const handleArchive = async () => {
    if (activeId) {
      await deleteNotification(activeId);
    }
  }

  const handleDelete = async (id: string) => {
    await deleteNotification(id);
  }

  const deleteNotification = async (id: string) => {
    try {
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
      await fetch(`/api/user/notifications/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': csrfToken || '',
        }
      });
      setNotifications((prev) => prev.filter((n) => n.id !== id));
      setActiveId(null);
    } catch (error) {
      console.error('Failed to delete notification', error);
    }
  };

  return (
    <Popover>
      <PopoverTrigger asChild>
        <button className="relative inline-flex items-center justify-center rounded-full p-2 hover:bg-muted text-gray-600 hover:text-red-900 transition">
          <Bell className="h-5 w-5" />
          {notifications.length > 0 && (
            <Badge
              variant="destructive"
              className="absolute -top-1 -right-1 text-[10px] px-1.5 py-0 min-w-[18px] h-[18px] flex items-center justify-center border-2 border-white"
            >
              {notifications.length}
            </Badge>
          )}
        </button>
      </PopoverTrigger>
      <PopoverContent
        className="w-80 p-0 border-white/10 bg-black/20 backdrop-blur-[20px] shadow-2xl rounded-2xl overflow-hidden"
        align="center"
        side={placement}
        style={{
          backgroundBlendMode: 'screen',
        }}
      >
        <Card className="max-h-80 overflow-y-auto border-none bg-transparent shadow-none">
          {notifications.length === 0 ? (
            <div className="p-4 text-sm text-white/50 text-center">
              No notifications
            </div>
          ) : (
            <ul className="divide-y divide-white/5">
              {notifications.map((item) => {
                const isActive = activeId === item.id
                return (
                  <li
                    key={item.id}
                    className="flex items-center justify-between p-4 hover:bg-white/5 transition"
                  >
                    {/* Left text with animation */}
                    <motion.div
                      animate={{ x: isActive ? -40 : 0 }}
                      transition={{ duration: 0.2 }}
                      className="flex-1"
                    >
                      <div className="flex justify-between items-center mb-1">
                        <span className="font-medium text-sm text-white">{item.title}</span>
                        <span className="text-[10px] text-white/40">
                          {item.time}
                        </span>
                      </div>
                      <p className="text-xs text-white/70 leading-relaxed">
                        {item.description}
                      </p>
                    </motion.div>

                    {/* Right side controls */}
                    <div className="ml-2 flex items-center">
                      {isActive ? (
                        <div className="flex items-center space-x-2">
                          <button
                            className="p-1 rounded-md hover:bg-white/10"
                            onClick={handleArchive}
                          >
                            <Archive className="h-4 w-4 text-white/60" />
                          </button>
                          <button
                            className="p-1 rounded-md hover:bg-white/10"
                            onClick={() => handleDelete(item.id)}
                          >
                            <Trash2 className="h-4 w-4 text-red-400" />
                          </button>
                          <button
                            className="p-1 rounded-md hover:bg-white/10"
                            onClick={() => setActiveId(null)}
                          >
                            <ChevronRight className="h-4 w-4 text-white/60" />
                          </button>
                        </div>
                      ) : (
                        <button
                          className="p-1 rounded-md hover:bg-white/5"
                          onClick={() =>
                            setActiveId(isActive ? null : item.id)
                          }
                        >
                          <GripVertical className="h-4 w-4 text-white/40" />
                        </button>
                      )}
                    </div>
                  </li>
                );
              })}
            </ul>
          )}
        </Card>
      </PopoverContent>
    </Popover>
  )
}
