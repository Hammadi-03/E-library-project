"use client";

import React from "react";
import { StatsCard } from "@/components/ui/stats-card-1";

interface LoanStatsCardProps {
    currentValue: number;
    title: string;
    description: string;
    chartData?: { name: string; value: number }[];
}

const defaultChartData = [
  { name: "S", value: 35 },
  { name: "M", value: 55 }, 
  { name: "T", value: 40 },
  { name: "W", value: 70 },
  { name: "T", value: 65 },
  { name: "F", value: 30 }, 
  { name: "S", value: 25 },
];

export default function LoanStatsCard({ currentValue, title, description, chartData }: LoanStatsCardProps) {
  // Use real data if provided, otherwise fallback to default
  const rawData = chartData || defaultChartData;

  // Find max value to normalize percentages (so the bars aren't tiny)
  const maxValue = Math.max(...rawData.map(d => d.value), 10); // at least 10 for scale
  
  const normalizedData = rawData.map(d => ({
    ...d,
    value: Math.max(5, (d.value / maxValue) * 100) // min 5% for visibility
  }));

  return (
    <StatsCard
      title={title}
      currentValue={currentValue}
      chartData={normalizedData}
      description={description}
      defaultBarColor="bg-blue-900/30"
      highlightedBarColor="bg-blue-900"
    />
  );
}
