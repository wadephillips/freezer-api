import SpaceCard from "@/Components/Spaces/SpaceCard";

export default function SpacesCardRow({spaces}) {
    return (
        <div>
            <h2 className="text-sm font-medium text-gray-500">Storage
                Spaces</h2>
            <ul role="list"
                className="mt-3 grid grid-cols-1 gap-5 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">
                {spaces.map((space) => (
                    <SpaceCard space={space}/>
                ))}
            </ul>
        </div>
    )
}
