import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import SpacesCardRow from "@/Components/Spaces/SpacesCardRow";

export default function Dashboard({spaces}) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Spaces
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">

                    <SpacesCardRow spaces={spaces}/>

                </div>
            </div>

        </AuthenticatedLayout>
    );
}
