import AppLayout from '@/layouts/app-layout';
import { BreadcrumbItem, Folder, File } from '@/types';
import { Head, Link } from '@inertiajs/react';
import { FileIcon, FolderIcon } from 'lucide-react';
import React from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Home',
        href: '/',
    },
];

export default function Dashboard({
    folders = [],
    files = []
}: {
    folders: Folder[];
    files: File[];
}) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />

            <h1 className='m-2'>My files and folders</h1>

            {folders?.length > 0 && (
                <div className='mx-8 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4'>
                    {folders.map((folder) => (
                        <React.Fragment key={folder.id}>
                            <Link href={'/folders/' + folder.id} className='rounded-md border border-solid border-primary p-2'>
                                <FolderIcon className='text-primary'></FolderIcon> {folder.label}
                            </Link>
                        </React.Fragment>
                    ))}
                </div>
            )}

            <div className='mx-8 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4'>
                {files.map((file) => (
                    <React.Fragment key={file.id}>
                        <div className='rounded-md border border-solid border-primary p-2 whitespace-nowrap overflow-hidden text-ellipsis'>
                            <FileIcon className='text-primary'></FileIcon> {file.name}
                        </div>
                    </React.Fragment>
                ))}
            </div>
        </AppLayout>
    );
}
