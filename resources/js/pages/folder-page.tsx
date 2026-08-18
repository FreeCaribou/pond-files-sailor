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
    isHome = false,
}: {
    currentFolder: Folder;
    folders: Folder[];
    files: File[];
    currentFolderAncestors: Folder[];
    isHome: boolean;
}) {

    const [breadcrumbs, setBreadcrumbs] = useState<BreadcrumbItem[]>([]);

    useEffect(() => {
        if (isHome) {
            setBreadcrumbs([{
                title: 'Home',
                href: '/',
            }]);
        } else {
            const tmpBreacrumbs: BreadcrumbItem[] = [{ title: currentFolder.label, href: `/folders/${currentFolder.id}` }];
            currentFolderAncestors.forEach(cfa => {
                tmpBreacrumbs.push({ title: cfa.label, href: `/folders/${cfa.id}` })
            });
            tmpBreacrumbs.push({ title: 'Home', href: '/' });
            setBreadcrumbs(tmpBreacrumbs.reverse());
        }

    }, [currentFolder, isHome]);

    return (
        <AppLayout breadcrumbs={breadcrumbs} folderId={currentFolder?.id}>
            <Head title={isHome ? 'Home' : currentFolder.label} />

            <h1 className='m-2'>{isHome ? 'My files and folders' : currentFolder.label}</h1>

            {folders?.length > 0 && (
                <div className='mx-8 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4'>
                    {folders.map((folder) => (
                        <React.Fragment key={folder.id}>
                            <Link href={'/folders/' + folder.id} className='rounded-md border text-secondary border-solid border-secondary p-2 flex gap-2'>
                                <FolderIcon /> {folder.label}
                            </Link>
                        </React.Fragment>
                    ))}
                </div>
            )}

            <div className='mx-8 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4'>
                {files.map((file) => (
                    <React.Fragment key={file.id}>
                        <div className='rounded-md border text-primary border-solid border-primary p-2 whitespace-nowrap overflow-hidden text-ellipsis'>
                            <FileIcon /> {file.name}
                        </div>
                    </React.Fragment>
                ))}
            </div>
        </AppLayout>
    );
}
