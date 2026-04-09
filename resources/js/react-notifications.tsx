import React from 'react';
import { createRoot } from 'react-dom/client';
import NotificationsWithActions from './components/ui/notifications-with-actions';
import { DonutChart } from './components/ui/donut-chart';
import LoanStatusChart from './components/LoanStatusChart';
import LoanStatsCard from './components/LoanStatsCard';

document.addEventListener('DOMContentLoaded', () => {
    // 1. Mount Notifications
    const notifRoot = document.getElementById('notifications-root');
    if (notifRoot) {
        const rawData = notifRoot.getAttribute('data-notifications');
        const items = rawData ? JSON.parse(rawData) : undefined;

        // Hide the Blade/Alpine fallback bell before React mounts
        notifRoot.querySelectorAll('.react-notifications-fallback').forEach(el => {
            (el as HTMLElement).style.display = 'none';
        });

        const root = createRoot(notifRoot);
        root.render(<NotificationsWithActions items={items} />);
    }



    // 3. Mount Loan Status Chart
    const loanRoot = document.getElementById('loan-status-chart-root');
    if (loanRoot) {
        const active = parseInt(loanRoot.getAttribute('data-active') || '0');
        const overdue = parseInt(loanRoot.getAttribute('data-overdue') || '0');
        const total = parseInt(loanRoot.getAttribute('data-total') || '1');
        const returned = Math.max(0, total - active - overdue);

        const data = [
            { value: active, color: "hsl(142 76% 36%)", label: "Active" },
            { value: overdue, color: "hsl(0 84% 60%)", label: "Overdue" },
            { value: returned, color: "hsl(215 25% 27%)", label: "Returned" },
        ];

        const root = createRoot(loanRoot);
        root.render(
            <LoanStatusChart 
                active={active} 
                overdue={overdue} 
                total={total} 
            />
        );
    }

    // 4. Mount Loan Statistics (Bar Chart)
    const statsRoot = document.getElementById('loan-statistics-root');
    if (statsRoot) {
        const title = statsRoot.getAttribute('data-title') || 'Statistics';
        const value = parseInt(statsRoot.getAttribute('data-value') || '0');
        const desc = statsRoot.getAttribute('data-description') || '';
        const chartDataRaw = statsRoot.getAttribute('data-chart');
        const chartData = chartDataRaw ? JSON.parse(chartDataRaw) : undefined;

        const root = createRoot(statsRoot);
        root.render(<LoanStatsCard currentValue={value} title={title} description={desc} chartData={chartData} />);
    }
});
