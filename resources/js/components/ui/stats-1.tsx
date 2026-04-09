"use client";

import * as React from "react";
import { cn } from "@/lib/utils";

interface CardProps extends React.HTMLAttributes<HTMLDivElement> {}
const Card = React.forwardRef<HTMLDivElement, CardProps>(
  ({ className, ...props }, ref) => (
    <div
      ref={ref}
      data-slot="card"
      className={cn(
        "bg-card text-card-foreground flex flex-col gap-6 rounded-xl border py-6 shadow-sm",
        className
      )}
      {...props}
    />
  )
);
Card.displayName = "Card";

interface CardHeaderProps extends React.HTMLAttributes<HTMLDivElement> {}
const CardHeader = React.forwardRef<HTMLDivElement, CardHeaderProps>(
  ({ className, ...props }, ref) => (
    <div
      ref={ref}
      data-slot="card-header"
      className={cn(
        "@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6",
        className
      )}
      {...props}
    />
  )
);
CardHeader.displayName = "CardHeader";

interface CardTitleProps extends React.HTMLAttributes<HTMLDivElement> {}
const CardTitle = React.forwardRef<HTMLDivElement, CardTitleProps>(
  ({ className, ...props }, ref) => (
    <div
      ref={ref}
      data-slot="card-title"
      className={cn("leading-none font-semibold", className)}
      {...props}
    />
  )
);
CardTitle.displayName = "CardTitle";

interface CardDescriptionProps extends React.HTMLAttributes<HTMLDivElement> {}
const CardDescription = React.forwardRef<HTMLDivElement, CardDescriptionProps>(
  ({ className, ...props }, ref) => (
    <div
      ref={ref}
      data-slot="card-description"
      className={cn("text-muted-foreground text-sm", className)}
      {...props}
    />
  )
);
CardDescription.displayName = "CardDescription";

interface CardActionProps extends React.HTMLAttributes<HTMLDivElement> {}
const CardAction = React.forwardRef<HTMLDivElement, CardActionProps>(
  ({ className, ...props }, ref) => (
    <div
      ref={ref}
      data-slot="card-action"
      className={cn(
        "col-start-2 row-span-2 row-start-1 self-start justify-self-end",
        className
      )}
      {...props}
    />
  )
);
CardAction.displayName = "CardAction";

interface CardContentProps extends React.HTMLAttributes<HTMLDivElement> {}
const CardContent = React.forwardRef<HTMLDivElement, CardContentProps>(
  ({ className, ...props }, ref) => (
    <div
      ref={ref}
      data-slot="card-content"
      className={cn("px-6", className)}
      {...props}
    />
  )
);
CardContent.displayName = "CardContent";

interface CardFooterProps extends React.HTMLAttributes<HTMLDivElement> {}
const CardFooter = React.forwardRef<HTMLDivElement, CardFooterProps>(
  ({ className, ...props }, ref) => (
    <div
      ref={ref}
      data-slot="card-footer"
      className={cn("flex items-center px-6 [.border-t]:pt-6", className)}
      {...props}
    />
  )
);
CardFooter.displayName = "CardFooter";

export interface StatItem {
  name: string;
  value: string | number;
  description: string;
  icon?: React.ReactNode;
  href?: string;
  color?: string;
}

interface StatsProps {
  items: StatItem[];
}

export default function StatsGroup({ items }: StatsProps) {
  return (
    <div className="w-full">
      <dl className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 w-full">
        {items.map((item) => (
          <Card key={item.name} className="p-0 gap-0 border-none shadow-md overflow-hidden group hover:shadow-lg transition-shadow duration-300">
            <CardContent className={cn("p-6 flex flex-col justify-between min-h-[140px] text-white", item.color || "bg-primary")}>
              <div className="flex justify-between items-start">
                <div>
                   <dt className="text-white/80 font-medium text-sm mb-1">
                    {item.name}
                  </dt>
                  <dd className="text-4xl leading-none font-bold mt-2">
                    {item.value}
                  </dd>
                </div>
                <div className="bg-white/20 w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-sm group-hover:scale-110 transition-transform">
                  {item.icon}
                </div>
              </div>
              
              <div className="mt-6 flex items-center gap-2 text-[11px] text-white bg-white/10 w-fit px-3 py-1 rounded-md font-medium capitalize">
                {item.description}
              </div>
            </CardContent>
            {item.href && (
              <CardFooter className="flex justify-end border-t border-border !p-0 bg-white">
                <a
                  href={item.href}
                  className="px-6 py-3 text-[11px] font-bold text-gray-500 hover:text-red-900 uppercase tracking-wider transition-colors"
                >
                  View details →
                </a>
              </CardFooter>
            )}
          </Card>
        ))}
      </dl>
    </div>
  );
}
