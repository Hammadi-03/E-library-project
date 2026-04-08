import React from 'react';
import { createRoot } from 'react-dom/client';
import NotificationsWithActions from './components/ui/notifications-with-actions';

document.addEventListener('DOMContentLoaded', () => {
    const rootElement = document.getElementById('notifications-root');
    if (rootElement) {
        const rawData = rootElement.getAttribute('data-notifications');
        const items = rawData ? JSON.parse(rawData) : undefined;

        // Hide the Blade/Alpine fallback bell before React mounts
        rootElement.querySelectorAll('.react-notifications-fallback').forEach(el => {
            (el as HTMLElement).style.display = 'none';
        });

        const root = createRoot(rootElement);
        root.render(<NotificationsWithActions items={items} />);
    }
});
