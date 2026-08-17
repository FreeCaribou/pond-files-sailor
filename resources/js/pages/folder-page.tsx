import AppLayout from '@/layouts/app-layout';
import { Folder, File, BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';
import { FileIcon, FolderIcon } from 'lucide-react';
import React, { useEffect, useState } from 'react';

export default function FolderPage({
    currentFolder,
    folders = [],
    files = [],
    currentFolderAncestors = [],
}: {
    currentFolder: Folder;
    folders: Folder[];
    files: File[];
    currentFolderAncestors: Folder[];
}) {

    const [breadcrumbs, setBreadcrumbs] = useState<BreadcrumbItem[]>([]);

    useEffect(() => {
        const tmpBreacrumbs: BreadcrumbItem[] = [{ title: currentFolder.label, href: `/folders/${currentFolder.id}` }];
        currentFolderAncestors.forEach(cfa => {
            tmpBreacrumbs.push({ title: cfa.label, href: `/folders/${cfa.id}` })
        });
        tmpBreacrumbs.push({ title: 'Home', href: '/' });
        setBreadcrumbs(tmpBreacrumbs.reverse());
    }, [currentFolder]);

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={currentFolder.label} />

            <h1 className='m-2'>{currentFolder.label}</h1>

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
