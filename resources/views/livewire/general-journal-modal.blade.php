<!-- ADD TRANSACTION MODAL -->
<div wire:ignore.self id="add-modal" tabindex="-1" aria-hidden="true" class="mt-10 hidden modal fade overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 fixed w-full max-w-2xl bg-white dark:bg-gray-700 z-10">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    Add New General Journal Entry
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-base w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                    data-modal-toggle="add-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body design -->
            <div class="p-4 pt-20 pb-16 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 overflow-y-auto max-h-[calc(100vh-160px)]">
                <!-- Function for adding -->    
                <form wire:submit.prevent="saveGeneralJournal">
                    <!-- Modal content -->
                    <div class="grid gap-4 p-4 mb-4 grid-cols-2">

                    <!-- Journal Info Form Fields  -->
                    <div class="col-span-2">
                        <div class="bg-white border border-gray-300 rounded-lg p-4"> <!-- Outer Rectangle -->
                            <text class="font-base font-bold">General Journal Information</text>
                            <hr class="my-4 w-full border-t border-gray-300">
                            <div class="grid gap-4 grid-cols-2">
                                <div class="col-span-1">
                                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Date</label>
                                        <input type="date" wire:model="gj_entrynum_date" class="mb-2 w-full bg-gray-50 border {{ $errors->has('gj_entrynum_date') ? 'border-red-500 ' : 'border-gray-300 text-gray-900' }} rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ">
                                        @error('gj_entrynum_date') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-1">
                                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Jev Number</label>
                                    <input type="text" wire:model="gj_jevnum" class="mb-2 bg-gray-50 border {{ $errors->has('gj_jevnum') ? 'border-red-500 ' : 'border-gray-300 text-gray-900' }} text-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " 
                                    placeholder="YYYY-MM-JEV Number"> 
                                    @error('gj_jevnum') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-span-2">
                                <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Particulars</label>
                                <textarea class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border {{ $errors->has('gj_particulars') ? 'border-red-500 ' : 'border-gray-300' }} focus:ring-blue-500 focus:border-blue-500 " id="description" 
                                rows="2" wire:model="gj_particulars"></textarea>
                                @error('gj_particulars') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>                       
                            
                        <!-- Sundry Form Fields  -->
                        @foreach ($gj_accountcodes_data as $index => $entry)
                            <div class="col-span-2">
                                <div class="bg-white border border-gray-300 rounded-lg p-4"> <!-- Outer Rectangle -->
                                    <div class="col-span-2 sm:col-span-1 items-center flex justify-between">
                                        <div>
                                            <text class="font-base font-bold ">Sundry</text>
                                        </div>
                                        <div>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-base w-6 h-6 ms-auto inline-flex justify-center items-center" 
                                                wire:click="removeAccountCode({{ $index }})">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                            </button>   
                                        </div>
                                    </div>
                                    <hr class="my-4 w-full border-t border-gray-300">                                                                
                                            <div class="grid gap-4">
                                                <div class="col-span-2" x-data="{ code: @entangle('gj_accountcodes_data.' . $index . '.gj_accountcode') }">
                                                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Account Code</label>
                                                    <select wire:model="gj_accountcodes_data.{{ $index }}.gj_accountcode" class="bg-gray-50 border {{ $errors->has('gj_accountcodes_data.' . $index . '.gj_accountcode') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                        <option value="">Select account code</option>
                                                        <option value="1 01 01 010 - Cash Local Treasury">1 01 01 010 - Cash Local Treasury</option>
                                                        <option value="1 01 01 020 - Petty Cash">1 01 01 020 - Petty Cash</option>
                                                        <option value="1 01 02 010 - Cash in Bank - Local Currency Current Account">1 01 02 010 - Cash in Bank - Local Currency Current Account</option>
                                                        <option value="1 01 02 020 - Cash in Bank - Local Currency Savings Account">1 01 02 020 - Cash in Bank - Local Currency Savings Account</option>
                                                        <option value="1 02 01 010 - Cash in Bank - Local Currency Time Deposits">1 02 01 010 - Cash in Bank - Local Currency Time Deposits</option>
                                                        <option value="1 01 03 020 - Cash in Bank - Foreign Currency Savings Account">1 01 03 020 - Cash in Bank - Foreign Currency Savings Account</option>
                                                        <option value="1 02 05 010 - Guaranty Deposits">1 02 05 010 - Guaranty Deposits</option>
                                                        <option value="1 03 01 010 - Accounts Receivable">1 03 01 010 - Accounts Receivable</option>
                                                        <option value="1 03 01 070 - Interests Receivable">1 03 01 070 - Interests Receivable</option>
                                                        <option value="1 03 03 010 - Due from National Government Agencies">1 03 03 010 - Due from National Government Agencies</option>
                                                        <option value="1 03 03 030 - Due from Local Government Units">1 03 03 030 - Due from Local Government Units</option>
                                                        <option value="1 03 05 020 - Advances for Payroll">1 03 05 020 - Advances for Payroll</option>
                                                        <option value="1 03 05 030 - Advances to Special Disbursing Officer">1 03 05 030 - Advances to Special Disbursing Officer</option>
                                                        <option value="1 03 05 040 - Advances for Officer and Employees">1 03 05 040 - Advances for Officer and Employees</option>
                                                        <option value="1 03 06 010 - Receivables - Disallowances / Charges">1 03 06 010 - Receivables - Disallowances / Charges</option>
                                                        <option value="1 03 06 020 - Due from Officers and Employees">1 03 06 020 - Due from Officers and Employees</option>
                                                        <option value="1 03 06 990 - Other Receivables">1 03 06 990 - Other Receivables</option>
                                                        <option value="1 03 01 011 - Allowance for Impairment Loss">1 03 01 011 - Allowance for Impairment Loss</option>
                                                        <option value="1 04 04 010 - Office Supplies Inventory">1 04 04 010 - Office Supplies Inventory</option>
                                                        <option value="1 04 04 020 - Accountable Forms,  Plates and Stickers">1 04 04 020 - Accountable Forms,  Plates and Stickers</option>
                                                        <option value="1 04 04 060 - Drugs and Medicines Inventory">1 04 04 060 - Drugs and Medicines Inventory</option>
                                                        <option value="1 04 04 070 - Medical, Dental and Laboratory Supplies Inventory">1 04 04 070 - Medical, Dental and Laboratory Supplies Inventory</option>
                                                        <option value="1 04 04 990 - Other Supplies and Materials Inventory">1 04 04 990 - Other Supplies and Materials Inventory</option>
                                                        <option value="1 05 01 010 - Advances to Contractors">1 05 01 010 - Advances to Contractors</option>
                                                        <option value="1 05 01 050 - Prepaid Insurance">1 05 01 050 - Prepaid Insurance</option>
                                                        <option value="1 05 01 990 - Other Prepayments">1 05 01 990 - Other Prepayments</option>
                                                        <option value="1 07 04 020 - School Buildings">1 07 04 020 - School Buildings</option>
                                                        <option value="1 07 04 021 - Accumulated Depreciation - School Buildings">1 07 04 021 - Accumulated Depreciation - School Buildings</option>
                                                        <option value="1 07 04 990 - Other Structures">1 07 04 990 - Other Structures</option>
                                                        <option value="1 07 04 991 - Accumulated Depreciation - Other Structures">1 07 04 991 - Accumulated Depreciation - Other Structures</option>
                                                        <option value="1 07 05 010 - Machinery">1 07 05 010 - Machinery</option>
                                                        <option value="1 07 05 011 - Accumulated Depreciation - Machinery">1 07 05 011 - Accumulated Depreciation - Machinery</option>
                                                        <option value="1 07 05 020 - Office Equipment">1 07 05 020 - Office Equipment</option>
                                                        <option value="1 07 05 021 - Accumulated Depreciation - Office Equipment">1 07 05 021 - Accumulated Depreciation - Office Equipment</option>
                                                        <option value="1 07 05 030 - Info and Communication Technology Equipment">1 07 05 030 - Info and Communication Technology Equipment</option>
                                                        <option value="1 07 05 031 - Accumulated Depreciation - ICT Equipment">1 07 05 031 - Accumulated Depreciation - ICT Equipment</option>
                                                        <option value="1 07 05 070 - Communication Equipment">1 07 05 070 - Communication Equipment</option>
                                                        <option value="1 07 05 071 - Acc Depreciation - Communication Equipment">1 07 05 071 - Acc Depreciation - Communication Equipment</option>
                                                        <option value="1 07 05 090 - Disaster Response and Rescue Equipment">1 07 05 090 - Disaster Response and Rescue Equipment</option>
                                                        <option value="1 07 05 091 - Acc Depreciation - Disaster Response and Rescue Equipment">1 07 05 091 - Acc Depreciation - Disaster Response and Rescue Equipment</option>
                                                        <option value="1 07 05 100 - Military, Police & Security Equipment">1 07 05 100 - Military, Police & Security Equipment</option>
                                                        <option value="1 07 05 101 - Acc Depreciation - Military, Police & Security Eqpmt">1 07 05 101 - Acc Depreciation - Military, Police & Security Eqpmt</option>
                                                        <option value="1 07 05 110 - Medical  Equipment">1 07 05 110 - Medical  Equipment</option>
                                                        <option value="1 07 05 111 - Accumulated Depreciation - Medical  Equipment">1 07 05 111 - Accumulated Depreciation - Medical  Equipment</option>
                                                        <option value="1 07 05 130 - Sports Equipment">1 07 05 130 - Sports Equipment</option>
                                                        <option value="1 07 05 131 - Accumulated Depreciation - Sports Equipment">1 07 05 131 - Accumulated Depreciation - Sports Equipment</option>
                                                        <option value="1 07 05 140 - Technical and Scientific Equipment">1 07 05 140 - Technical and Scientific Equipment</option>
                                                        <option value="1 07 05 141 - Acc Depreciation - Technical & Scientific Equipment">1 07 05 141 - Acc Depreciation - Technical & Scientific Equipment</option>
                                                        <option value="1 07 05 990 - Other Machinery & Equipment">1 07 05 990 - Other Machinery & Equipment</option>
                                                        <option value="1 07 05 991 - Acc Depreciation - Other Machinery & Equipment">1 07 05 991 - Acc Depreciation - Other Machinery & Equipment</option>
                                                        <option value="1 07 06 010 - Motor Vehicles">1 07 06 010 - Motor Vehicles</option>
                                                        <option value="1 07 06 011 - Accumulated Depreciation - Motor Vehicles">1 07 06 011 - Accumulated Depreciation - Motor Vehicles</option>
                                                        <option value="1 07 07 010 - Furniture and Fixtures">1 07 07 010 - Furniture and Fixtures</option>
                                                        <option value="1 07 07 011 - Accumulated Depreciation - Furniture and Fixtures">1 07 07 011 - Accumulated Depreciation - Furniture and Fixtures</option>
                                                        <option value="1 07 07 020 - Books">1 07 07 020 - Books</option>
                                                        <option value="1 07 07 021 - Accumulated Depreciation -  Books">1 07 07 021 - Accumulated Depreciation -  Books</option>
                                                        <option value="1 07 99 090 - Disaster Response & Rescue Equipt">1 07 99 090 - Disaster Response & Rescue Equipt</option>
                                                        <option value="1 07 99 990 - Other Property, Plant and Equipment">1 07 99 990 - Other Property, Plant and Equipment</option>
                                                        <option value="1 07 99 991 - Acc Depreciation - Property, Plant and Equipment">1 07 99 991 - Acc Depreciation - Property, Plant and Equipment</option>
                                                        <option value="1 07 10 020 - Infrastructure Assets">1 07 10 020 - Infrastructure Assets</option>
                                                        <option value="1 07 10 030 - Buildings  and  Other Structures">1 07 10 030 - Buildings  and  Other Structures</option>
                                                        <option value="2 01 01 010 - Accounts Payable">2 01 01 010 - Accounts Payable</option>
                                                        <option value="2 01 01 020 - Due to Officers and Employees">2 01 01 020 - Due to Officers and Employees</option>
                                                        <option value="2 02 01 010 - Due to BIR">2 02 01 010 - Due to BIR</option>
                                                        <option value="2 02 01 020 - Due to GSIS">2 02 01 020 - Due to GSIS</option>
                                                        <option value="2 02 01 030 - Due to PAG-IBIG">2 02 01 030 - Due to PAG-IBIG</option>
                                                        <option value="2 02 01 040 - Due to PHILHEALTH">2 02 01 040 - Due to PHILHEALTH</option>
                                                        <option value="2 04 01 010 - Trust Liabilities">2 04 01 010 - Trust Liabilities</option>
                                                        <option value="2 04 01 040 - Guaranty/Security Deposits Payable">2 04 01 040 - Guaranty/Security Deposits Payable</option>
                                                        <option value="2 04 01 050 - Customers' Deposit">2 04 01 050 - Customers' Deposit</option>
                                                        <option value="2 05 01 990 - Other Deferred Credits">2 05 01 990 - Other Deferred Credits</option>
                                                        <option value="2 99 99 990 - Other Payables">2 99 99 990 - Other Payables</option>
                                                        <option value="3 01 01 010 - Government Equity">3 01 01 010 - Government Equity</option>
                                                        <option value="3 01 01 020 - Prior Period Adjustment">3 01 01 020 - Prior Period Adjustment</option>
                                                        <option value="4 02 01 040 - Clearance and Certification Fees">4 02 01 040 - Clearance and Certification Fees</option>
                                                        <option value="4 02 01 980 - Fines and Penalties - Service Income">4 02 01 980 - Fines and Penalties - Service Income</option>
                                                        <option value="4 02 01 990 - Other Service Income">4 02 01 990 - Other Service Income</option>
                                                        <option value="4 02 02 010 - School Fees">4 02 02 010 - School Fees</option>
                                                        <option value="4 02 02 020 - Affiliation Fees">4 02 02 020 - Affiliation Fees</option>
                                                        <option value="4 02 02 050 - Rent Income">4 02 02 050 - Rent Income</option>
                                                        <option value="4 02 02 220 - Interest Income">4 02 02 220 - Interest Income</option>
                                                        <option value="4 02 02 990 - Other Business Income">4 02 02 990 - Other Business Income</option>
                                                        <option value="4 03 01 020 - Subsidy from  LGUs">4 03 01 020 - Subsidy from  LGUs</option>
                                                        <option value="4 04 02 010 - Grants & Donations in Cash">4 04 02 010 - Grants & Donations in Cash</option>
                                                        <option value="4 04 02 020 - Grants & Donations in Kind">4 04 02 020 - Grants & Donations in Kind</option>
                                                        <option value="4 06 01 010 - Miscellaneous Income">4 06 01 010 - Miscellaneous Income</option>
                                                        <option value="4 03 01 020 - Subsidy from  LGUs">4 03 01 020 - Subsidy from  LGUs</option>
                                                        <option value="5 01 01 010 - Salaries and Wages - Regular">5 01 01 010 - Salaries and Wages - Regular</option>
                                                        <option value="5 01 01 020 - Salaries and Wages - Casual/Contractual">5 01 01 020 - Salaries and Wages - Casual/Contractual</option>
                                                        <option value="5 01 02 010 - Personnel Economic Relief Allowance  ( PERA )">5 01 02 010 - Personnel Economic Relief Allowance  ( PERA )</option>
                                                        <option value="5 01 02 020 - Representation Allowance  ( RA )">5 01 02 020 - Representation Allowance  ( RA )</option>
                                                        <option value="5 01 02 030 - Transportation Allowance  ( TA )">5 01 02 030 - Transportation Allowance  ( TA )</option>
                                                        <option value="5 01 02 040 - Clothing / Uniform Allowance">5 01 02 040 - Clothing / Uniform Allowance</option>
                                                        <option value="5 01 02 050 - Subsistence Allowance">5 01 02 050 - Subsistence Allowance</option>
                                                        <option value="5 01 02 060 - Laundry Allowance">5 01 02 060 - Laundry Allowance</option>
                                                        <option value="5 01 02 080 - Productivity Incentive Allowance">5 01 02 080 - Productivity Incentive Allowance</option>
                                                        <option value="5 01 02 100 - Honoraria">5 01 02 100 - Honoraria</option>
                                                        <option value="5 01 02 110 - Hazard Pay">5 01 02 110 - Hazard Pay</option>
                                                        <option value="5 01 02 120 - Longevity Pay">5 01 02 120 - Longevity Pay</option>
                                                        <option value="5 01 02 130 - Overtime and Night Pay">5 01 02 130 - Overtime and Night Pay</option>
                                                        <option value="5 01 02 140 - Year End Bonus">5 01 02 140 - Year End Bonus</option>
                                                        <option value="5 01 02 150 - Cash Gift">5 01 02 150 - Cash Gift</option>
                                                        <option value="5 01 02 990 - Other Bonuses and Allowances">5 01 02 990 - Other Bonuses and Allowances</option>
                                                        <option value="5 01 03 010 - Retirement and Life Insurance Premiums">5 01 03 010 - Retirement and Life Insurance Premiums</option>
                                                        <option value="5 01 03 020 - Pag-ibig Contributions">5 01 03 020 - Pag-ibig Contributions</option>
                                                        <option value="5 01 03 030 - PhilHealth Contributions">5 01 03 030 - PhilHealth Contributions</option>
                                                        <option value="5 01 03 040 - Employees Compensation Insurance Premiums">5 01 03 040 - Employees Compensation Insurance Premiums</option>
                                                        <option value="5 01 04 030 - Terminal Leave Benefits">5 01 04 030 - Terminal Leave Benefits</option>
                                                        <option value="5 01 04 990 - Other Personnel Benefits">5 01 04 990 - Other Personnel Benefits</option>
                                                        <option value="5 02 01 010 - Travelling Expenses - Local">5 02 01 010 - Travelling Expenses - Local</option>
                                                        <option value="5 02 01 020 - Travelling Expenses - Foreign">5 02 01 020 - Travelling Expenses - Foreign</option>
                                                        <option value="5 02 02 010 - Training Expenses">5 02 02 010 - Training Expenses</option>
                                                        <option value="5 02 03 010 - Office Supplies Expenses">5 02 03 010 - Office Supplies Expenses</option>
                                                        <option value="5 02 03 020 - Accountable Forms Expenses">5 02 03 020 - Accountable Forms Expenses</option>
                                                        <option value="5 02 03 070 - Drugs and Medicines Expenses">5 02 03 070 - Drugs and Medicines Expenses</option>
                                                        <option value="5 02 03 080 - Medical, Dental and Laboratory Supplies Expenses">5 02 03 080 - Medical, Dental and Laboratory Supplies Expenses</option>
                                                        <option value="5 02 03 090 - Fuel, Oil and Lubricants Expenses">5 02 03 090 - Fuel, Oil and Lubricants Expenses</option>
                                                        <option value="5 02 03 990 - Other Supplies and Materials Expenses">5 02 03 990 - Other Supplies and Materials Expenses</option>
                                                        <option value="5 02 04 010 - Water Expenses">5 02 04 010 - Water Expenses</option>
                                                        <option value="5 02 04 020 - Electricity Expenses">5 02 04 020 - Electricity Expenses</option>
                                                        <option value="5 02 05 010 - Postage and Courier Services">5 02 05 010 - Postage and Courier Services</option>
                                                        <option value="5 02 05 020 - Telephone Expenses">5 02 05 020 - Telephone Expenses</option>
                                                        <option value="5 02 05 030 - Internet Subscription Expenses">5 02 05 030 - Internet Subscription Expenses</option>
                                                        <option value="5 02 05 040 - Cable,Satellite,Telegraph and Radio Expenses">5 02 05 040 - Cable,Satellite,Telegraph and Radio Expenses</option>
                                                        <option value="5 02 10 030 - Extraordinary and Miscellaneous Expenses">5 02 10 030 - Extraordinary and Miscellaneous Expenses</option>
                                                        <option value="5 02 11 030 - Consultancy Services">5 02 11 030 - Consultancy Services</option>
                                                        <option value="5 02 11 990 - Other Professional Services">5 02 11 990 - Other Professional Services</option>
                                                        <option value="5 02 12 020 - Janitorial Services">5 02 12 020 - Janitorial Services</option>
                                                        <option value="5 02 12 030 - Security Services">5 02 12 030 - Security Services</option>
                                                        <option value="5 02 13 040 - Repairs and Maint - Building & Other Structures">5 02 13 040 - Repairs and Maint - Building & Other Structures</option>
                                                        <option value="5 02 13 050 - Repairs and Maint - Machinery and Equipment">5 02 13 050 - Repairs and Maint - Machinery and Equipment</option>
                                                        <option value="5 02 13 060 - Repairs and Maint - Transportation Equipment">5 02 13 060 - Repairs and Maint - Transportation Equipment</option>
                                                        <option value="5 02 13 070 - Repairs and Maintenance - Furniture and Fixtures">5 02 13 070 - Repairs and Maintenance - Furniture and Fixtures</option>
                                                        <option value="5 02 16 020 - Fidelity Bond Premiums">5 02 16 020 - Fidelity Bond Premiums</option>
                                                        <option value="5 02 16 030 - Insurance Expenses">5 02 16 030 - Insurance Expenses</option>
                                                        <option value="5 02 99 010 - Advertising Expenses">5 02 99 010 - Advertising Expenses</option>
                                                        <option value="5 02 99 020 - Printing and Publication Expenses">5 02 99 020 - Printing and Publication Expenses</option>
                                                        <option value="5 02 99 030 - Representation  Expenses">5 02 99 030 - Representation  Expenses</option>
                                                        <option value="5 02 99 050 - Rent Expenses">5 02 99 050 - Rent Expenses</option>
                                                        <option value="5 02 99 060 - Membership Dues and Contribution  to Org.">5 02 99 060 - Membership Dues and Contribution  to Org.</option>
                                                        <option value="5 02 99 070 - Subscription Expenses">5 02 99 070 - Subscription Expenses</option>
                                                        <option value="5 02 99 990 - Other Maintenance and Operating Expenses">5 02 99 990 - Other Maintenance and Operating Expenses</option>
                                                        <option value="5 03 01 040 - Bank Charges">5 03 01 040 - Bank Charges</option>
                                                        <option value="5 05 01 040 - Depreciation- Building and Structures">5 05 01 040 - Depreciation- Building and Structures</option>
                                                        <option value="5 05 01 050 - Depreciation- Machinery and Equipment">5 05 01 050 - Depreciation- Machinery and Equipment</option>
                                                        <option value="5 05 01 060 - Depreciation- Transportation Equipment">5 05 01 060 - Depreciation- Transportation Equipment</option>
                                                        <option value="5 05 01 070 - Depreciation- Furnitures and Books">5 05 01 070 - Depreciation- Furnitures and Books</option>
                                                        <option value="5 05 01 090 - Depreciation- Disaster Response & Rescue Equipt.">5 05 01 090 - Depreciation- Disaster Response & Rescue Equipt.</option>
                                                        <option value="5 05 01 990 - Depreciation- Other Property Plant and Equipment">5 05 01 990 - Depreciation- Other Property Plant and Equipment</option>
                                                        <option value="5 05 03 060 - Impairment Loss-Receivable">5 05 03 060 - Impairment Loss-Receivable</option>
                                                        <option value="5 05 04 990 - Other Losses">5 05 04 990 - Other Losses</option>
                                                    </select>     
                                                @error('gj_accountcodes_data.' . $index . '.gj_accountcode') <span class="text-red-500">{{ $message }}</span> @enderror
                                                <div class="relative">
                                                    <ul class="text-gray-700 mt-1 w-full border-2 shadow-xl rounded-lg absolute bg-white  cursor-pointer focus:outline-none" x-show="filteredItems.length > 0" @mousedown.away="clearSuggestions">
                                                        <template x-for="(item, index) in filteredItems" :key="item">
                                                            <li class="p-2 border-t border-gray-200 hover:bg-gray-50" @mousedown.prevent="setInputValue(item)">
                                                                <button type="button" x-text="item"></button>
                                                            </li>
                                                        </template>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class ="col-span-2 sm:col-span-1">
                                                <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white ">Debit</label>
                                                <input type="number" wire:model="gj_accountcodes_data.{{ $index }}.gj_debit" class="bg-gray-50 border 
                                                {{ $errors->has('gj_accountcodes_data.' . $index . '.gj_debit') ? 'border-red-500 ' : 'border-gray-300' }} border-gray-300 text-gray-900 text-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " 
                                                placeholder="₱">
                                                @error('gj_accountcodes_data.' . $index . '.gj_debit') <span class="text-red-500">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div class="col-span-2 sm:col-span-1">
                                                <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Credit</label>
                                                <input type="number" wire:model="gj_accountcodes_data.{{ $index }}.gj_credit" class="bg-gray-50 border 
                                                {{ $errors->has('gj_accountcodes_data.' . $index . '.gj_credit') ? 'border-red-500 ' : 'border-gray-300' }} border-gray-300 text-gray-900 text-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " 
                                                placeholder="₱">
                                                @error('gj_accountcodes_data.' . $index . '.gj_credit') <span class="text-red-500">{{ $message }}</span> @enderror
                                            </div>
                                    </div>

                                </div>
                            </div>                       
                        @endforeach
                          
                        <!-- Add sundry button -->
                        <div class="col-span-2">
                            <label class="cursor-pointer border border-gray-300 mr-2 text-black w-full inline-flex items-center hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-base px-5 py-2.5 text-center"
                                wire:click="addAccountCode">
                                        <svg class="fill-current h-4 w-4 mr-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                                        </svg> Add Sundry
                            </label> 
                        </div>      
                    </div> <!-- Modal content div tag -->
                   
                    <!-- Modal footer -->
                    <div class="absolute bottom-0 left-0 w-full bg-white dark:bg-gray-700 rounded-b">
                        <div class="flex justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 max-w-2xl mx-auto">
                            

                            <!-- Notification Message -->
                            <div class="mr-4 ml-4 flex-grow text-left text-green-800" x-data="{ show: @entangle('showNotification') }">
                                <div class="flex items-center" x-show="show" x-init="@this.on('notification-shown', () => { setTimeout(() => { $wire.call('resetNotification') }, 3000); })">
                                    <div class="font-semibold w-full bg-green-50 rounded-lg px-5 py-2.5 flex items-center">
                                        <svg class="w-5 h-5 mr-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"></path>
                                        </svg>
                                        {{ $notificationMessage }}
                                    </div>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end">
                                <!-- Cancel Button -->
                                <button type="button" data-modal-toggle="add-modal" class="mr-2 text-black inline-flex items-center bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-base px-5 py-2.5 text-center">
                                    Cancel
                                    <span class="sr-only">Close modal</span>
                                </button>

                                <!-- Add Transaction Button -->
                                {{-- <button type="submit" @keydown.enter.prevent="$wire.saveGeneralJournal()" class="text-white inline-flex items-center bg-blue-800 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center" style="font-weight: bold;">
                                    Add Transaction
                                </button> --}}
                                <button type="submit" wire:click="saveLedgerSheetCode" class="text-white inline-flex items-center bg-blue-800 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center" style="font-weight: bold;">
                                    Add Transaction
                                </button>
                            </div>
                        </div>
                    </div>

                </form> <!-- Function div tag -->

            </div> <!-- Modal body design div tag -->
        </div>
    </div> 
</div>

<!-- DELETE MODAL -->
<div wire:ignore.self id="delete-modal" tabindex="-1" aria-hidden="true" class="hidden modal fade overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    Are you sure you want to delete this item?
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-base w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                    data-modal-toggle="delete-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-3 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <!-- Modal body -->
                <form wire:submit.prevent="destroyGeneralJournal">
                    <div class="grid gap-4 p-2 mb-4">
                        <p class="text-lg leading-relaxed text-gray-500 dark:text-gray-400">
                            This action cannot be undone. This will permanently delete the row from the database. 
                        </p>
                    </div>
                    <div class="col-span-2 flex justify-end mr-2">
                            <button type="button" data-modal-toggle="delete-modal" class="mr-2 text-black inline-flex items-center bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-base px-5 py-2.5 text-center">
                                    Cancel
                                    <span class="sr-only">Close modal</span>
                            </button>    
                            <button type="submit" class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-base px-5 py-2.5 text-center">
                                    Delete
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>

<!-- IMPORT MODAL -->
<div wire:ignore.self id="import-modal" tabindex="-1" aria-hidden="true" class="hidden modal fade overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white" >
                    Import data to journal
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-base w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                    data-modal-toggle="import-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
                <!-- Import body -->
                <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex items-center justify-center w-full">
                        <label for="customFile" class="relative flex flex-col items-center justify-center w-full h-36 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400" id="fileName">
                                    @if($file)
                                        <span class="font-semibold">{{ $file->getClientOriginalName() }}</span> <!--Madidisplay name ng uploaded file-->
                                    @else
                                        <span class="font-semibold">Click to upload Excel file</span>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Make sure that your header rows match the header rows in this table.</p>
                                    @endif
                                </p>
                            </div>
                            <input type="file" wire:model="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" id="customFile" />
                        </label>
                    </div>
                    <div class="col-span-2 flex justify-end mr-2 mt-4">            
                        <button class="text-white inline-flex items-center bg-blue-800 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                            wire:click="importGJ">
                            Import 
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> 



<!-- EXPORT MODAL -->
<div wire:ignore.self id="export-modal" tabindex="-1" aria-hidden="true" class="hidden modal fade overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white" >
                    Export table to CSV or XLSX
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-base w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                    data-modal-toggle="export-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
                <!-- Export body -->
                <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" x-data="{ exportFormat: 'xlsx' }">
                    <!-- Radio buttons -->
                    <div class="flex flex-col mb-4">
                        <div class="flex items-center">
                            <input id="default-radio-1" type="radio" value="csv" name="default-radio" class="cursor-pointer ml-4 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @click="exportFormat = 'csv'">
                            <label for="default-radio-1" class="ms-2 text-xl font-medium text-gray-900 dark:text-gray-300">CSV</label>
                        </div>
                        <div class="text-base text-gray-500 ml-6">Export table to Comma Separated Value file</div>
                    </div>
                    <div class="flex flex-col mb-4">
                        <div class="flex items-center">
                            <input checked id="default-radio-2" type="radio" value="xlsx" name="default-radio" class="cursor-pointer ml-4 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @click="exportFormat = 'xlsx'">
                            <label for="default-radio-2" class="ms-2 text-xl font-medium text-gray-900 dark:text-gray-300">XLSX</label>
                        </div>
                        <div class="text-base text-gray-500 ml-6">Export table to Microsoft Excel Spreadsheet File</div>
                    </div>
                    <!-- Export button -->
                    <div class="col-span-2 flex justify-end mr-2 mt-4">            
                        <button id="export-csv" button class="text-white inline-flex items-center bg-blue-800 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                        wire:click="exportGJ_CSV" x-show="exportFormat === 'csv'">Export</button>
                        <button id="export-xlsx" button class="text-white inline-flex items-center bg-blue-800 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                        wire:click="exportGJ_XLSX" x-show="exportFormat === 'xlsx'">Export</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> 