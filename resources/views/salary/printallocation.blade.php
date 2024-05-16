<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print All</title>


    <!-- CSS Files -->
    {{-- <link id="pagestyle" href="{{ public_path ('assets/libs/bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet" /> --}}
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
        }

        .dash-line {
            border: none;
            border-top: 2px dashed #888;
        }

        .tb-noborder th,
        .tb-noborder td {
            border: none;
            width: auto;
        }

        .tb-collapse table,
        th,
        td {
            width: 100%;
            border: 0.1px solid #000;
            border-collapse: collapse;
            font-size: 7pt;
            padding: 0px 2px 0px 2px
        }

        .uppercase {
            text-transform: uppercase;
        }

        .text-end {
            text-align: right;
        }
    </style>
</head>

<body>
    <table class="tb-noborder" width="100%">
        <tr>
            <td align="center">PT BRIDGESTONE KALIMANTAN PLANTATION</td>
        </tr>
        <tr>
            <td align="center" class="uppercase">SALARY ALLOCATION {{ $date }}</td>
        </tr>
        <tr></tr>
    </table>

    {{-- <hr class="dash-line"> --}}
    <div class="tb-collapse">
        <table>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Allocation</th>
                <th colspan="11">Salary Component</th>
                <th rowspan="2">Salary Gross + Benefite</th>
                <th colspan="7">Deduction</th>
                <th rowspan="2">Total Deduction + Benefite Deduction</th>
                <th rowspan="2">Net Salary</th>
            </tr>
            <tr>
                <th>Salary Grade</th>
                <th>Ability</th>
                <th>Fungtional Allowance</th>
                <th>Family Allowance</th>
                <th>Adjustment</th>
                <th>Transport Allowance</th>
                <th>Total Overtime</th>
                <th>THR</th>
                <th>Bonus</th>
                <th>Incentive</th>
                <th>Salary Gross</th>
                {{-- <th>Salary gross + Benefite</th> --}}
                <th>BPJS Kesehatan</th>
                <th>Jamsostek</th>
                <th>Union</th>
                <th>Absent</th>
                <th>Electricity</th>
                <th>Koperasi</th>
                <th>Sub Total Deduction</th>
                {{-- <th>Total Deduction</th> --}}
                {{-- <th>Net Salary</th> --}}
            </tr>

            @foreach ($finalResult as $index => $sal)
                @php
                    $subtotal = 0; // Inisialisasi subtotal per status
                @endphp

                {{-- @foreach ($salaries as $sal) --}}
                <tr>
                    <td class="text-end">{{ $index + 1 }}</td>
                    <td>{{ $sal['allocation'] }}</td>
                    <td class="text-end">{{ number_format($sal['rate_salary'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($sal['ability'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($sal['fungtional_alw'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($sal['family_alw'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($sal['adjustment'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($sal['transport_alw'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($sal['total_overtime'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($sal['thr'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($sal['bonus'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($sal['incentive'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($sal['gross_salary'], 0, ',', '.') }}</td>
                    <td class="text-end">
                        {{ number_format($sal['gross_salary'] + $sal['total_ben'], 0, ',', '.') }}
                    </td>
                    <td class="text-end">{{ number_format($sal['bpjs'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($sal['jamsostek'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($sal['union'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($sal['absent'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($sal['electricity'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($sal['cooperative'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($sal['total_deduction'], 0, ',', '.') }}</td>
                    <td class="text-end">
                        {{ number_format($sal['total_deduction'] + $sal['total_ben_ded'], 0, ',', '.') }}
                    </td>
                    <td class="text-end">{{ number_format($sal['net_salary'], 0, ',', '.') }}</td>
                </tr>
            @endforeach

            {{-- tr untuk grand total data alokasi gaji --}}
            <tr style="background: #dddddd">
                <td colspan="2" style="font-weight: bold">Grand Total</td>
                {{-- <td></td> --}}
                <td class="text-end">{{ number_format($grandTotal['rate_salary'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['ability'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['fungtional_alw'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['family_alw'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['adjustment'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['transport_alw'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['total_overtime'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['thr'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['bonus'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['incentive'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['gross_salary'], 0, ',', '.') }}</td>
                <td class="text-end">
                    {{ number_format($grandTotal['gross_salary'] + $grandTotal['total_ben'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['bpjs'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['jamsostek'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['union'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['absent'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['electricity'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['cooperative'], 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($grandTotal['total_deduction'], 0, ',', '.') }}</td>
                <td class="text-end">
                    {{ number_format($grandTotal['total_deduction'] + $grandTotal['total_ben_ded'], 0, ',', '.') }}
                </td>
                <td class="text-end">{{ number_format($grandTotal['net_salary'], 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
