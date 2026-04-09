import React from 'react';
import { createRoot } from 'react-dom/client';
import NotificationsWithActions from './components/ui/notifications-with-actions';
import { DonutChart } from './components/ui/donut-chart';
import LoanStatusChart from './components/LoanStatusChart';
import LoanStatsCard from './components/LoanStatsCard';

import StatsGroup from './components/ui/stats-1';
import { BookMarked, FileText, Users, Hourglass, BookOpen } from 'lucide-react';

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

    // 2. Mount Summary Stats Grid
    const summaryRoot = document.getElementById('summary-stats-root');
    if (summaryRoot) {
        const data = JSON.parse(summaryRoot.getAttribute('data-stats') || '{}');
        const labels = JSON.parse(summaryRoot.getAttribute('data-labels') || '{}');

        const items = [
            {
                name: labels.total_books || 'Total Books',
                value: data.total_books,
                description: labels.available || 'Available in library',
                icon: <BookMarked className="w-5 h-5" />,
                color: 'bg-[#1b5b3e]', // Dark Green
                href: '/books'
            },
            {
                name: labels.total_loans || 'Total Loans',
                value: data.total_loans,
                description: labels.all_transactions || 'All transactions recorded',
                icon: <FileText className="w-5 h-5" />,
                color: 'bg-yellow-500', // Yellow
                href: '/loans'
            },
            {
                name: labels.active_loans || 'Active Loans',
                value: data.active_loans,
                description: labels.active_borrowing || 'Active borrowing',
                icon: <BookOpen className="w-5 h-5" />,
                color: 'bg-blue-600', // Blue
                href: '/loans?status=borrowed'
            },
            {
                name: labels.overdue_books || 'Overdue Books',
                value: data.overdue_loans,
                description: labels.take_action || 'Take action soon',
                icon: <Hourglass className="w-5 h-5" />,
                color: 'bg-red-900', // Red
                href: '/loans?status=overdue'
            }
        ];

        const root = createRoot(summaryRoot);
        root.render(<StatsGroup items={items} />);
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
