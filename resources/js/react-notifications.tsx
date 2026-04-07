import React from 'react';
import { createRoot } from 'react-dom/client';
import NotificationsWithActions from './components/ui/notifications-with-actions';

document.addEventListener('DOMContentLoaded', () => {
    const rootElement = document.getElementById('notifications-root');
    if (rootElement) {
        const rawData = rootElement.getAttribute('data-notifications');
        const items = rawData ? JSON.parse(rawData) : undefined;
        
        const root = createRoot(rootElement);
        root.render(<NotificationsWithActions items={items} />);
    }
});
