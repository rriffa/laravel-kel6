<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    @if(session()->has('message'))
    <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 relative" role="alert" x-data="{show: true}" x-show="show">
        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
        <p>{{ session('message') }}</p>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
            <svg class="fill-current h-6 w-6 text-white" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
    </div>
    @endif
    <div class="mt-8 text-2xl flex justify-between">
        <div>Data Pajak</div> 
        <div class="mr-2">
            <x-jet-button wire:click="confirmItemAdd" class="bg-blue-500 hover:bg-blue-700">
                Add New Item
            </x-jet-button>
        </div>
    </div>

    <div class="mt-6">
        <div class="flex justify-between">
            <div class="">
                <input wire:model.debounce.500ms="q" type="search" placeholder="Search" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
            </div>
            {{-- <div class="mr-2">
                <input type="checkbox" class="mr-2 leading-tight" wire:model="active" />Active Only?
            </div> --}}
        </div>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('nomor')">No</button>
                            <x-sort-icon sortField="nomor" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('id')">ID</button>
                            <x-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('kode_pajak')">Kode Pajak</button>
                            <x-sort-icon sortField="kode_pajak" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('nama_pajak')">Nama Pajak</button>
                            <x-sort-icon sortField="nama_pajak" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('deskripsi')">Deskripsi</button>
                            <x-sort-icon sortField="deskripsi" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('tarif_pajak')">Tarif Pajak</button>
                            <x-sort-icon sortField="tarif_pajak" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('tanggal_berlaku')">Tanggal Berlaku</button>
                            <x-sort-icon sortField="tanggal_berlaku" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    {{-- @if(!$active)
                        <th class="px-4 py-2">
                            Status
                        </th>
                    @endif --}}
                    <th class="px-4 py-2">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $index=>$item)
                    <tr>
                        <th class="border px-4 py-2">{{ $index + 1}}</th>                        
                        <td class="border px-4 py-2">{{ $item->id }}</td>
                        <td class="border px-4 py-2">{{ $item->kode_pajak }}</td>
                        <td class="border px-4 py-2">{{ $item->nama_pajak }}</td>
                        <td class="border px-4 py-2">{{ $item->deskripsi }}</td>
                        <td class="border px-4 py-2">{{ 'Rp ' . number_format($item->tarif_pajak, 0, ',', '.') }}</td>
                        <td class="border px-4 py-2">{{ $item->tanggal_berlaku }}</td>
                        {{-- @if(!$active)
                            <td class="border px-4 py-2">{{ $item->status ? 'Active' : 'Not Active' }}</td>
                        @endif --}}
                        <td class="border px-4 py-2">
                            <x-jet-button wire:click="confirmItemEdit({{ $item->id }})" class="bg-orange-500 hover:bg-orange-700">
                                Edit
                            </x-jet-button>
                            <x-jet-danger-button wire:click="confirmItemDeletion({{ $item->id }})" wire:loading.attr="disabled">
                                Delete
                            </x-jet-danger-button>
                            <x-jet-button wire:click="show({{ $item->id }})" class="bg-blue-500 hover:bg-blue-700">
                                Show
                            </x-jet-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $items->links() }}
    </div>

    <x-jet-confirmation-modal wire:model="confirmingItemDeletion">
        <x-slot name="title">
            {{ __('Delete Item') }}
        </x-slot>
    
        <x-slot name="content">
            {{ __('Are you sure you want to delete this Item?') }}
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('confirmingItemDeletion', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
    
            <x-jet-danger-button class="ml-2" wire:click="deleteItem({{ $confirmingItemDeletion }})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
    
    <x-jet-dialog-modal wire:model="confirmingItemAdd">
        <x-slot name="title">
            {{ isset($this->item['id']) ? 'Edit Item' : 'Add Item' }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="kode_pajak" value="{{ __('Kode Pajak') }}" />
                <x-jet-input id="kode_pajak" type="text" class="mt-1 block w-full" wire:model.defer="item.kode_pajak" />
                <x-jet-input-error for="item.kode_pajak" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="nama_pajak" value="{{ __('Nama Pajak') }}" />
                <x-jet-input id="nama_pajak" type="text" class="mt-1 block w-full" wire:model.defer="item.nama_pajak" />
                <x-jet-input-error for="item.nama_pajak" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="deskripsi" value="{{ __('Deskripsi') }}" />
                <textarea id="deskripsi" class="mt-1 block w-full form-textarea" wire:model.defer="item.deskripsi" rows="4" ></textarea>
                <x-jet-input-error for="item.deskripsi" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="tarif_pajak" value="{{ __('Tarif Pajak') }}" />
                <x-jet-input id="tarif_pajak" type="text" class="mt-1 block w-full" wire:model.defer="item.tarif_pajak" />
                <x-jet-input-error for="item.tarif_pajak" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="tanggal_berlaku" value="{{ __('Tanggal Berlaku') }}" />
                <x-jet-input id="tanggal_berlaku" type="date" class="mt-1 block w-full" wire:model.defer="item.tanggal_berlaku" />
                <x-jet-input-error for="item.tanggal_berlaku" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('confirmingItemAdd', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="saveItem()" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="showingItem">
        <x-slot name="title">
            {{ __('Item Details') }}
        </x-slot>
    
        <x-slot name="content">
            @if ($item)
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="kode_pajak" value="{{ __('Kode Pajak') }}" />
                    <x-jet-input id="kode_pajak" type="text" class="mt-1 block w-full" value="{{ $item['kode_pajak'] ?? '' }}" readonly />
                </div>
    
                <div class="col-span-6 sm:col-span-4 mt-4">
                    <x-jet-label for="nama_pajak" value="{{ __('Nama Pajak') }}" />
                    <x-jet-input id="nama_pajak" type="text" class="mt-1 block w-full" value="{{ $item['nama_pajak'] ?? '' }}" readonly />
                </div>
    
                <div class="col-span-6 sm:col-span-4 mt-4">
                    <x-jet-label for="deskripsi" value="{{ __('Deskripsi') }}" />
                    <textarea id="deskripsi" class="mt-1 block w-full form-textarea" readonly>{{ $item['deskripsi'] ?? '' }}</textarea>
                </div>
    
                <div class="col-span-6 sm:col-span-4 mt-4">
                    <x-jet-label for="tarif_pajak" value="{{ __('Tarif Pajak') }}" />
                    <x-jet-input id="tarif_pajak" type="text" class="mt-1 block w-full" value="{{ $item['tarif_pajak'] ?? '' }}" readonly />
                </div>
    
                <div class="col-span-6 sm:col-span-4 mt-4">
                    <x-jet-label for="tanggal_berlaku" value="{{ __('Tanggal Berlaku') }}" />
                    <x-jet-input id="tanggal_berlaku" type="text" class="mt-1 block w-full" value="{{ $item['tanggal_berlaku'] ?? '' }}" readonly />
                </div>
            @endif
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('showingItem', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
    
        
</div>
