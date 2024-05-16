@foreach ($salary_months as $key => $sal)
    <div class="modal fade" id="detailGaji{{ $sal->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-form"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Data Gaji</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <style>
                    .tb-detail {
                        border-collapse: collapse;
                        width: 100%;
                    }

                    .tb-detail th,
                    .tb-detail td {
                        border: none;
                    }

                    .right-border {
                        border-top: 1px solid #000;
                    }

                    .left-border {
                        border-top: 1px solid #000;
                    }

                    .buttom-border {
                        border-top: 1px solid #000;
                    }

                    .top-border {
                        border-top: 1px solid #000;
                    }

                    .dash-line {
                        border: none;
                        border-top: 3px dashed #888;
                    }
                </style>
                @php
                    $rate_salary = $sal->salary_year->salary_grade->rate_salary;
                    $ability = $sal->salary_year->ability;
                    $fungtional_alw = $sal->salary_year->fungtional_alw;
                    $family_alw = $sal->salary_year->family_alw;

                    $total = $rate_salary + $ability + $fungtional_alw + $family_alw;
                @endphp
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            PT BRIDGESTONE KALIMANTAN PLANTATION
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            Bentok Darat, Bati-Bati, Kab.Tanah Laut
                        </div>
                        <div class="col d-flex text-uppercase justify-content-end">
                            SALARY PAYMENT {{ date('F Y', strtotime($sal->date)) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <u>Kalimantan Selatan - 70852</u>
                        </div>
                    </div>
                    <hr class="dash-line">
                    <div class="row">
                        <div class="col">
                            <table class="tb-detail">
                                <tr>
                                    <td>Employe Code </td>
                                    <td> : {{ $sal->salary_year->user->nik }}</td>
                                </tr>
                                <tr>
                                    <td>Employe Name</td>
                                    <td>: {{ $sal->salary_year->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Grade</td>
                                    <td>: {{ $sal->salary_year->user->grade->name_grade }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>: {{ $sal->salary_year->user->status->name_status }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col">
                            <table class="tb-detail">
                                <tr>
                                    <td>Departement</td>
                                    <td>: {{ $sal->salary_year->user->dept->name_dept }}</td>
                                </tr>
                                <tr>
                                    <td>Job</td>
                                    <td>: {{ $sal->salary_year->user->job->name_job }}</td>
                                </tr>
                                <tr>
                                    <td>Start working</td>
                                    <td>: {{ date('M d, Y', strtotime($sal->salary_year->user->start)) }}</td>
                                </tr>
                                <tr>
                                    <td>Tax Number</td>
                                    <td>:- </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr class="dash-line">
                    <div class="row">
                        <div class="col">
                            <table class="tb-detail">
                                <tr>
                                    <td colspan="2"><u><b>A. SALARY COMPONENT</b></u></td>
                                </tr>
                                <tr>
                                    <td>Grade</td>
                                    <td>:</td>
                                    <td class="text-end">
                                        {{ number_format($sal->salary_year->salary_grade->rate_salary, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ability</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($sal->salary_year->ability, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Fungtional Allowance</td>
                                    <td>:</td>
                                    <td class="text-end">
                                        {{ number_format($sal->salary_year->fungtional_alw, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Family Allowance</td>
                                    <td>:</td>
                                    <td class="text-end">
                                        {{ number_format($sal->salary_year->family_alw, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Adjustment</td>
                                    <td>:</td>
                                    <td class="text-end">
                                        {{ number_format($sal->salary_year->adjustment, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Transport Allowance</td>
                                    <td>:</td>
                                    <td class="text-end">
                                        {{ number_format($sal->salary_year->transport_alw, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Overtime</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($sal->total_overtime, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>THR</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($sal->thr, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Bonus</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($sal->bonus, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Incentive</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($sal->incentive, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="top-border">
                                    <td><b>Salary Gross</b></td>
                                    <td>:</td>
                                    <td class="text-end"><b>
                                            {{ number_format($sal->gross_salary, 0, ',', '.') }}</b>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col">
                            <table class="tb-detail">
                                <tr>
                                    <td colspan="2"><u><b>B. DEDUCTION</b></u></td>
                                </tr>
                                <tr>
                                    <td>BPJS</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($sal->salary_year->bpjs, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Jamsostek</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($sal->salary_year->jamsostek, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Union</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($sal->union, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Absent</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($sal->absent, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Electricity</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($sal->electricity, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Cooperative</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($sal->cooperative, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="top-border">
                                    <td><b>Sub Total</b></td>
                                    <td>:</td>
                                    <td class="text-end"><b>
                                            {{ number_format($sal->total_deduction, 0, ',', '.') }}</b>
                                    </td>
                                </tr>
                            </table>
                            <div class="border border-dark p-2">
                                <table class="tb-detail">
                                    <tr>
                                        <td>Salary Gross + <br>Total Benefit</td>
                                        <td>:</td>
                                        <td class="text-end">
                                            {{ number_format($sal->gross_salary + $sal->salary_year->total_ben, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Deduction</td>
                                        <td>:</td>
                                        <td class="text-end">
                                            {{ number_format($sal->total_deduction + $sal->salary_year->total_ben_ded, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr class="top-border">
                                        <td><b>Nett Salary</b></td>
                                        <td>:</td>
                                        <td class="text-end"><b>
                                                {{ number_format($sal->net_salary, 0, ',', '.') }}</b>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col">
                            <table class="tb-detail">
                                <tr>
                                    <td colspan="2"><u><b>C. BENEFIT</b></u></td>
                                </tr>
                                <tr>
                                    <td>Jamsostek JKK</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($total * 0.0054, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jamsostek TK</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($total * 0.003, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jamsostek THT</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($total * 0.037, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tax PPh 21</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($sal->pph21_ben, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="top-border">
                                    <td><b>Sub Total</b></td>
                                    <td>:</td>
                                    <td class="text-end"><b>
                                            {{ number_format($sal->salary_year->total_ben, 0, ',', '.') }}</b>
                                    </td>
                                </tr>
                            </table>
                            <table class="tb-detail">
                                <tr>
                                    <td colspan="2"><u><b>D. DEDUCTION BENEFIT</b></u></td>
                                </tr>
                                <tr>
                                    <td>Jamsostek JKK</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($total * 0.0054, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jamsostek TK</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($total * 0.003, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jamsostek THT</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($total * 0.037, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tax PPh 21</td>
                                    <td>:</td>
                                    <td class="text-end">{{ number_format($sal->pph21_deb, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="top-border">
                                    <td><b>Sub Total</b></td>
                                    <td><b>:</b></td>
                                    <td class="text-end"><b>
                                            {{ number_format($sal->salary_year->total_ben_ded, 0, ',', '.') }}</b>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm  btn-outline-secondary btn-3"
                        data-bs-dismiss="modal">Close</button>
                    <a href="{{ url('/download-pdf/' . $sal->id) }}" class="btn btn-icon btn-3 btn-warning btn-sm"
                        target="_blank">
                        <span class="btn-inner--icon"><i class="material-icons">download</i></span>
                        <span class="btn-inner--text">Download</span>
                    </a>
                    <a href="{{ url('/print-pdf/' . $sal->id) }}" class="btn btn-icon btn-3 btn-warning btn-sm"
                        target="_blank">
                        <span class="btn-inner--icon"><i class="material-icons">print</i></span>
                        <span class="btn-inner--text">Print</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
