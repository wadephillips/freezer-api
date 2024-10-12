import {EllipsisVerticalIcon} from "@heroicons/react/20/solid";
import {router} from "@inertiajs/react";

function classNames(...classes) {
    return classes.filter(Boolean).join(' ')
}

export default function SpaceCard({space})
{
    const initials = space.name.charAt(0);

    function handleClick() {
        router.get(route('spaces.show', space.id ))
    }

    return (
        <li key={space.name} className="col-span-1 flex rounded-md shadow-sm" onClick={handleClick}>
            <div
                className={
                    'bg-gray-100 dark:bg-gray-700 flex w-16 flex-shrink-0 items-center justify-center rounded-l-md text-sm font-medium text-white'}
            >
                {initials}
            </div>
            <div
                className="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                <div className="flex-1 truncate px-4 py-2 text-sm">
                    <a href={space.href}
                       className="font-medium text-gray-900 hover:text-gray-600">
                        {space.name}
                    </a>
                    <p className="text-gray-500">{space.description}</p>
                </div>

            </div>
        </li>
    )
}
