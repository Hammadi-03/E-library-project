import React from 'react';
import { createRoot } from 'react-dom/client';
import NotificationsWithActions from './components/ui/notifications-with-actions';
import HeroSpline from './components/ui/HeroSpline';

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

    // 2. Mount 3D Spline Hero Component
    const splineRoot = document.getElementById('hero-spline-root');
    if (splineRoot) {
        const root = createRoot(splineRoot);
        root.render(<HeroSpline />);
    }
});
