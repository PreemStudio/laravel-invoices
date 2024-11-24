<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="preload" as="style" href="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp" />
    <link rel="stylesheet" href="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp" />
</head>

<body class="font-sans text-sm antialiased">
    <div class="py-16">
        <div class="flex items-center justify-between">
            <h2 class="text-6xl font-black leading-6 text-gray-900">Invoice</h2>
            <img src="https://tailwindui.com/img/logos/48x48/tuple.svg" alt="Invoice"
                class="h-16 w-16 flex-none rounded-full">
        </div>

        <dl class="grid grid-cols-2 leading-6">
            <div class="mt-8 border-t border-gray-900/5 pt-6 sm:pr-4">
                <dt class="font-semibold text-gray-900">
                    From
                </dt>
                <dd class="mt-2 text-gray-500">
                    {{ $invoice->vendor->address->toString() }}
                </dd>
            </div>
            <div class="mt-8 border-t border-gray-900/5 pl-4 pt-6">
                <dt class="font-semibold text-gray-900">
                    To
                </dt>
                <dd class="mt-2 text-gray-500">
                    {{ $invoice->customer->address->toString() }}
                </dd>
            </div>
            <div class="pt-6 sm:pr-4">
                <dt class="font-semibold text-gray-900">
                    Invoice ID
                </dt>
                <dd class="mt-2 text-gray-500">
                    {{ $invoice->identifier }}
                </dd>
            </div>
            <div class="pl-4 pt-6">
                <dt class="font-semibold text-gray-900">
                    Invoice Date
                </dt>
                <dd class="mt-2 text-gray-500">
                    {{ $invoice->date->format($dateFormat) }}
                </dd>
            </div>
        </dl>

        <table class="mt-16 w-full whitespace-nowrap text-left leading-6">
            <colgroup>
                <col class="w-full">
                <col>
                <col>
                <col>
                <col>
                <col>
            </colgroup>

            <thead class="border-b border-gray-200 text-gray-900">
                <tr>
                    <th scope="col" class="px-0 py-3 font-semibold">
                        Description
                    </th>

                    <th scope="col" class="table-cell py-3 pl-8 pr-0 text-right font-semibold">
                        Quantity
                    </th>

                    <th scope="col" class="table-cell py-3 pl-8 pr-0 text-right font-semibold">
                        Unit
                    </th>

                    <th scope="col" class="table-cell py-3 pl-8 pr-0 text-right font-semibold">
                        Tax
                    </th>

                    <th scope="col" class="table-cell py-3 pl-8 pr-0 text-right font-semibold">
                        Rate
                    </th>

                    <th scope="col" class="py-3 pl-8 pr-0 text-right font-semibold">
                        Price
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($invoice->items as $item)
                    <tr class="border-b border-gray-100">
                        <td class="max-w-0 px-0 py-5 align-top">
                            <div class="truncate font-medium text-gray-900">
                                {{ $item->name }}
                            </div>

                            @if($item->description)
                                <div class="truncate text-gray-500">
                                    {{ $item->description }}
                                </div>
                            @endif
                        </td>

                        <td class="align-center table-cell py-5 pl-8 pr-0 text-right tabular-nums text-gray-700">
                            {{ $item->quantity }}
                        </td>

                        <td class="align-center table-cell py-5 pl-8 pr-0 text-right tabular-nums text-gray-700">
                            {{ $item->unit }}
                        </td>

                        <td class="align-center table-cell py-5 pl-8 pr-0 text-right tabular-nums text-gray-700">
                            {{ $item->tax()->toString() }}
                        </td>

                        <td class="align-center table-cell py-5 pl-8 pr-0 text-right tabular-nums text-gray-700">
                            {{ $item->rate->toString() }}
                        </td>

                        <td class="align-center table-cell py-5 pl-8 pr-0 text-right tabular-nums text-gray-700">
                            {{ $item->total()->toString() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                @if ($invoice->discounts)
                    <tr>
                        <th scope="row" colspan="5"
                            class="table-cell px-0 pb-0 pt-6 text-right font-normal text-gray-700">
                            Discounts
                        </th>
                        <td class="pb-0 pl-8 pr-0 pt-4 text-right tabular-nums text-gray-900">
                            {{ $invoice->discount()->toString() }}
                        </td>
                    </tr>
                @endif

                <tr>
                    @if ($invoice->discounts)
                        <th scope="row" colspan="5" class="table-cell pt-4 text-right font-normal text-gray-700">
                    @else
                        <th scope="row" colspan="5" class="table-cell px-0 pb-0 pt-6 text-right font-normal text-gray-700">
                    @endif
                        Subtotal
                    </th>
                    <td class="pb-0 pl-8 pr-0 pt-6 text-right tabular-nums text-gray-900">
                        {{ $invoice->subtotal()->toString() }}
                    </td>
                </tr>

                <tr>
                    <th scope="row" colspan="5" class="table-cell pt-4 text-right font-normal text-gray-700">
                        Tax
                    </th>
                    <td class="pb-0 pl-8 pr-0 pt-4 text-right tabular-nums text-gray-900">
                        {{ $invoice->tax()->toString() }}
                    </td>
                </tr>

                <tr>
                    <th scope="row" colspan="5" class="table-cell pt-4 text-right font-semibold text-gray-900">
                        Total
                    </th>
                    <td class="pb-0 pl-8 pr-0 pt-4 text-right font-semibold tabular-nums text-gray-900">
                        {{ $invoice->total()->toString() }}
                    </td>
                </tr>
            </tfoot>
        </table>

        <dl class="mt-8 grid grid-cols-4 leading-6">
            <div class="mt-8 border-t border-gray-900/5 pt-6 sm:pr-4">
                <dt class="font-semibold text-gray-900">
                    Vendor
                </dt>
                <dd class="mt-2 text-gray-500">
                    Line1<br>Line2<br>Line3<br>Line4
                </dd>
            </div>

            <div class="mt-8 border-t border-gray-900/5 pl-4 pt-6">
                <dt class="font-semibold text-gray-900">
                    Contact
                </dt>
                <dd class="mt-2 text-gray-500">
                    Line1<br>Line2<br>Line3<br>Line4
                </dd>
            </div>

            <div class="mt-8 border-t border-gray-900/5 pl-4 pt-6">
                <dt class="font-semibold text-gray-900">
                    Tax
                </dt>
                <dd class="mt-2 text-gray-500">
                    Line1<br>Line2<br>Line3<br>Line4
                </dd>
            </div>

            <div class="mt-8 border-t border-gray-900/5 pl-4 pt-6">
                <dt class="font-semibold text-gray-900">
                    Bank
                </dt>
                <dd class="mt-2 text-gray-500">
                    Line1<br>Line2<br>Line3<br>Line4
                </dd>
            </div>
        </dl>
    </div>
</body>

</html>
