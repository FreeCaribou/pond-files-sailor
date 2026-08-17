import { Form } from '@inertiajs/react';
import { FolderPlus } from 'lucide-react';
import { useState } from 'react';
import { Button } from './ui/button';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from './ui/dialog';
import { Field, FieldGroup } from './ui/field';
import { Label } from './ui/label';
import { Input } from './ui/input';

export default function NewFolderForm({
    folderId,
}: {
    folderId?: string;
}) {
    const [openDialogAddFolder, setOpenDialogAddFolder] = useState(false);

    const handleSuccess = () => {
        setOpenDialogAddFolder(false);
    }

    return (
        <div>
            <Dialog open={openDialogAddFolder} onOpenChange={setOpenDialogAddFolder}>
                <DialogTrigger asChild>
                    <Button variant="ghost" className="cursor-pointer">
                        <FolderPlus className="text-secondary" /> Add folder
                    </Button>
                </DialogTrigger>
                <DialogContent className="sm:max-w-sm">
                    <DialogHeader>
                        <DialogTitle>Add a new dossier</DialogTitle>
                        <DialogDescription className='text-secondary'>
                            Create a new dossier
                        </DialogDescription>
                    </DialogHeader>
                    <Form method='post' action={'/folders' + (folderId ? `/${folderId}` : '')} resetOnSuccess={['label', 'description']} onSuccess={handleSuccess}>
                        <FieldGroup>
                            <Field>
                                <Label htmlFor="form-folder-label" className='text-secondary'>Label *</Label>
                                <Input id="form-folder-label" className='focus-visible:ring-secondary' name="label" />
                            </Field>
                            <Field>
                                <Label htmlFor="form-folder-description" className='text-secondary'>Description</Label>
                                <Input id="form-folder-description" className='focus-visible:ring-secondary' name="description" />
                            </Field>
                        </FieldGroup>
                        <DialogFooter className='mt-5'>
                            <Button type="submit" className='bg-secondary'>Save changes</Button>
                        </DialogFooter>
                    </Form>
                </DialogContent>
            </Dialog>
        </div>
    );
}
