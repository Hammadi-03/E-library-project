"use client";

import React, { useState } from "react";
import { DonutChart } from "@/components/ui/donut-chart";
import { motion, AnimatePresence } from "framer-motion";
import { cn } from "@/lib/utils";

interface LoanStatusChartProps {
  active: number;
  overdue: number;
  total: number;
}

export default function LoanStatusChart({ active, overdue, total }: LoanStatusChartProps) {
  const returned = Math.max(0, total - active - overdue);
  const loanData = [
    { value: active, color: "hsl(142 76% 36%)", label: "Active" },
    { value: overdue, color: "hsl(0 84% 60%)", label: "Overdue" },
    { value: returned, color: "hsl(215 25% 27%)", label: "Returned" },
  ];

  const [hoveredSegment, setHoveredSegment] = useState<string | null>(null);

  // Find the currently hovered segment data
  const activeSegment = loanData.find((segment) => segment.label === hoveredSegment);
  
  // Determine display values
  const displayValue = activeSegment?.value ?? (active + overdue);
  const displayLabel = activeSegment?.label ?? "Borrowed";
  const displayPercentage = total > 0 
    ? (activeSegment ? (activeSegment.value / total) * 100 : ((active + overdue) / total) * 100)
    : 0;

  return (
    <div className="flex flex-col items-center justify-center space-y-6 w-full">
      <div className="relative flex items-center justify-center">
        <DonutChart
          data={loanData}
          size={160}
          strokeWidth={20}
          animationDuration={1.2}
          animationDelayPerSegment={0.05}
          highlightOnHover={true}
          onSegmentHover={(segment) => setHoveredSegment(segment?.label || null)}
          centerContent={
            <AnimatePresence mode="wait">
              <motion.div
                key={displayLabel}
                initial={{ opacity: 0, scale: 0.9 }}
                animate={{ opacity: 1, scale: 1 }}
                exit={{ opacity: 0, scale: 0.9 }}
                transition={{ duration: 0.2, ease: "circOut" }}
                className="flex flex-col items-center justify-center text-center"
              >
                <p className="text-muted-foreground text-[10px] font-medium truncate max-w-[80px]">
                  {displayLabel}
                </p>
                <p className="text-2xl font-bold text-foreground">
                  {displayValue}
                </p>
                <p className="text-xs font-medium text-muted-foreground">
                    [{displayPercentage.toFixed(0)}%]
                </p>
              </motion.div>
            </AnimatePresence>
          }
        />
      </div>

      <div className="flex flex-col space-y-1 w-full pt-4 border-t border-border">
        {loanData.map((segment, index) => (
          <motion.div
            key={segment.label}
            className={cn(
              "flex items-center justify-between p-1.5 rounded-md transition-all duration-200 cursor-pointer",
              hoveredSegment === segment.label && "bg-muted"
            )}
            onMouseEnter={() => setHoveredSegment(segment.label)}
            onMouseLeave={() => setHoveredSegment(null)}
          >
            <div className="flex items-center space-x-2">
              <span
                className="h-2 w-2 rounded-full"
                style={{ backgroundColor: segment.color }}
              ></span>
              <span className="text-[11px] font-medium text-foreground">
                {segment.label}
              </span>
            </div>
            <span className="text-[11px] font-semibold text-muted-foreground">
              {segment.value}
            </span>
          </motion.div>
        ))}
      </div>
    </div>
  );
}
