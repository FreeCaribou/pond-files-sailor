import { Form } from '@inertiajs/react';
import { FolderPlus } from 'lucide-react';
import { useState } from 'react';
import { Button } from './ui/button';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from './ui/dialog';
import { Field, FieldGroup } from './ui/field';
import { Label } from './ui/label';
import { Input } from './ui/input';

export default function NewFileForm({
    folderId,
}: {
    folderId?: string;
}) {
    const [openDialogAddFile, setOpenDialogAddFile] = useState(false);

    const handleSuccess = () => {
        setOpenDialogAddFile(false);
    }

    return (
        <div>
            <Dialog open={openDialogAddFile} onOpenChange={setOpenDialogAddFile}>
                <DialogTrigger asChild>
                    <Button variant="ghost" className="cursor-pointer">
                        <FolderPlus className="text-secondary" /> Add file
                    </Button>
                </DialogTrigger>
                <DialogContent className="sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl">
                    <DialogHeader>
                        <DialogTitle>Add file</DialogTitle>
                        <DialogDescription className='text-secondary'>
                            Save a new file in the pond
                        </DialogDescription>
                    </DialogHeader>
                    <Form method='post' action={folderId ? `/folders/${folderId}/files` : '/files'}
                        resetOnSuccess={['file', 'description']} onSuccess={handleSuccess}>
                        <FieldGroup>
                            <Field>
                                <Label htmlFor="form-file-file" className='text-secondary'>File *</Label>
                                <Input id="form-file-label" className='focus-visible:ring-secondary' name="file" type='file' />
                            </Field>
                            <Field>
                                <Label htmlFor="form-file-description" className='text-secondary'>Description</Label>
                                <Input id="form-file-description" className='focus-visible:ring-secondary' name="description" />
                            </Field>
                        </FieldGroup>
                        <DialogFooter className='mt-5'>
                            <Button type="submit" className='bg-secondary'>Save file</Button>
                        </DialogFooter>
                    </Form>
                </DialogContent>
            </Dialog>
        </div>
    );
}
