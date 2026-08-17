import { AppContent } from '@/components/app-content';
import { AppHeader } from '@/components/app-header';
import { AppShell } from '@/components/app-shell';
import { type BreadcrumbItem } from '@/types';

interface AppHeaderLayoutProps {
    children: React.ReactNode;
    breadcrumbs?: BreadcrumbItem[];
    folderId?: string;
}

export default function AppHeaderLayout({ children, breadcrumbs, folderId }: AppHeaderLayoutProps) {
    return (
        <AppShell>
            <AppHeader breadcrumbs={breadcrumbs} folderId={folderId} />
            <AppContent>{children}</AppContent>
        </AppShell>
    );
}
