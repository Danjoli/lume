<x-store.app-layout>

    <x-store.home.hero />

    <x-store.home.categories
        :categories="$categories"
    />

    <x-store.home.best-sellers
        :books="$bestSellers"
    />

    <x-store.home.new-releases
        :books="$newReleases"
    />

    <x-store.home.promotions
        :books="$promotions"
    />

</x-store.app-layout>
