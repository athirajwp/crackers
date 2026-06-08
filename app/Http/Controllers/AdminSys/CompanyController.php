<?php

namespace App\Http\Controllers\AdminSys;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display the website overview / company list.
     */
    public function index()
    {
        // Self-healing database initialization with new schema
        $this->ensureTableExists();

        $companies = Company::orderBy('id', 'asc')->get();

        return view('admin_sys.company', compact('companies'));
    }

    /**
     * Store a newly created company.
     */
    public function store(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('Company store request received:', $request->all());

        $request->validate([
            'code' => 'required|string|max:255|unique:companies,code',
            'name' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        // Handle standard dynamic file uploads
        $files = ['bank_qr_1', 'bank_qr_2', 'bank_qr_3', 'logo_path', 'favicon_path'];
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $request->validate([
                    $file => 'image|mimes:jpeg,png,jpg,webp,gif|max:3072'
                ]);
                
                $fileName = time() . '_' . $file . '_' . uniqid() . '.' . $request->file($file)->extension();
                $request->file($file)->move(public_path('uploads/sys_companies'), $fileName);
                $data[$file] = 'uploads/sys_companies/' . $fileName;
            }
        }

        Company::create($data);

        return redirect()->route('admin_sys.company.index')->with('success', 'New domain company registered successfully!');
    }

    /**
     * Update an existing company domain record.
     */
    public function update(Request $request, $id)
    {
        \Illuminate\Support\Facades\Log::info("Company update request received for ID $id:", $request->all());

        $company = Company::findOrFail($id);

        $request->validate([
            'code' => 'required|string|max:255|unique:companies,code,' . $id,
            'name' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        // Handle standard dynamic file uploads
        $files = ['bank_qr_1', 'bank_qr_2', 'bank_qr_3', 'logo_path', 'favicon_path'];
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $request->validate([
                    $file => 'image|mimes:jpeg,png,jpg,webp,gif|max:3072'
                ]);

                // Delete old file if exists
                $oldPath = $company->{$file};
                if ($oldPath && file_exists(public_path($oldPath))) {
                    @unlink(public_path($oldPath));
                }
                
                $fileName = time() . '_' . $file . '_' . uniqid() . '.' . $request->file($file)->extension();
                $request->file($file)->move(public_path('uploads/sys_companies'), $fileName);
                $data[$file] = 'uploads/sys_companies/' . $fileName;
            }
        }

        $company->update($data);

        return redirect()->route('admin_sys.company.index')->with('success', 'Domain company details updated successfully!');
    }

    /**
     * Delete a company domain record.
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        
        // Delete uploaded files
        $files = ['bank_qr_1', 'bank_qr_2', 'bank_qr_3', 'logo_path', 'favicon_path'];
        foreach ($files as $file) {
            $path = $company->{$file};
            if ($path && file_exists(public_path($path))) {
                @unlink(public_path($path));
            }
        }

        $company->delete();

        return redirect()->route('admin_sys.company.index')->with('success', 'Domain company profile deleted successfully!');
    }

    /**
     * Ensure the companies table is dynamically created and seeded if missing.
     */
    private function ensureTableExists()
    {
        // Self-healing drop logic if table lacks the new "code" column or needs seeded SMTP fields updated
        $needsSeedingUpdate = false;
        if (Schema::hasTable('companies')) {
            if (Schema::hasColumn('companies', 'code') && Schema::hasColumn('companies', 'smtp_host')) {
                $test = Company::where('code', 'mahesh')->first();
                if ($test && empty($test->smtp_host)) {
                    $needsSeedingUpdate = true;
                }
            } else {
                $needsSeedingUpdate = true;
            }
        }

        if (Schema::hasTable('companies') && (!Schema::hasColumn('companies', 'code') || $needsSeedingUpdate)) {
            Schema::dropIfExists('companies');
        }

        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function ($table) {
                $table->id();
                
                // Main Info
                $table->string('code')->unique();
                $table->string('name');
                $table->string('website');
                $table->string('gst_number')->nullable();
                $table->string('pan_number')->nullable();
                $table->string('msme_number')->nullable();
                $table->string('theme')->nullable();
                $table->string('type')->nullable();
                $table->string('status')->default('active');
                
                // Contacts
                $table->string('contact_1')->nullable();
                $table->string('contact_2')->nullable();
                $table->string('contact_3')->nullable();
                $table->string('contact_4')->nullable();
                $table->string('contact_5')->nullable();
                $table->string('email_1')->nullable();
                $table->string('email_2')->nullable();
                $table->string('address_1')->nullable();
                $table->string('address_2')->nullable();
                $table->string('state')->nullable();
                $table->string('city')->nullable();
                $table->string('pincode')->nullable();
                $table->text('map_link')->nullable();

                // Bank Account 1
                $table->string('bank_qr_1')->nullable();
                $table->string('bank_name_1')->nullable();
                $table->string('bank_ifsc_1')->nullable();
                $table->string('bank_acc_1')->nullable();
                $table->string('bank_branch_1')->nullable();
                $table->string('bank_type_1')->nullable();
                $table->string('bank_holder_1')->nullable();
                
                // Bank Account 2
                $table->string('bank_qr_2')->nullable();
                $table->string('bank_name_2')->nullable();
                $table->string('bank_ifsc_2')->nullable();
                $table->string('bank_acc_2')->nullable();
                $table->string('bank_branch_2')->nullable();
                $table->string('bank_type_2')->nullable();
                $table->string('bank_holder_2')->nullable();
                
                // Bank Account 3
                $table->string('bank_qr_3')->nullable();
                $table->string('bank_name_3')->nullable();
                $table->string('bank_ifsc_3')->nullable();
                $table->string('bank_acc_3')->nullable();
                $table->string('bank_branch_3')->nullable();
                $table->string('bank_type_3')->nullable();
                $table->string('bank_holder_3')->nullable();

                // Promos
                $table->string('promo_code_1')->nullable();
                $table->string('promo_value_1')->nullable();
                $table->string('promo_code_2')->nullable();
                $table->string('promo_value_2')->nullable();
                $table->string('promo_code_3')->nullable();
                $table->string('promo_value_3')->nullable();
                $table->string('promo_code_4')->nullable();
                $table->string('promo_value_4')->nullable();
                $table->string('promo_code_5')->nullable();
                $table->string('promo_value_5')->nullable();

                // SMTP
                $table->string('smtp_host')->nullable();
                $table->string('smtp_port')->nullable();
                $table->string('smtp_user')->nullable();
                $table->string('smtp_pass')->nullable();
                $table->string('smtp_ssl')->nullable();

                // SMS
                $table->string('sms_header')->nullable();
                $table->string('sms_apikey')->nullable();
                $table->string('sms_balance')->nullable();

                // Other
                $table->string('min_purchase')->nullable();
                $table->string('tax_calc')->nullable();
                $table->string('delivery_calc')->nullable();

                // Socials Overview
                $table->string('fb_link')->nullable();
                $table->string('tw_link')->nullable();
                $table->string('yt_link')->nullable();
                $table->string('wa_link')->nullable();
                $table->string('ig_link')->nullable();
                $table->string('pin_link')->nullable();
                $table->string('copyright_text')->nullable();
                $table->string('logo_path')->nullable();
                $table->string('favicon_path')->nullable();

                $table->timestamps();
            });

            Company::create([
                'code' => 'mahesh',
                'name' => 'Mahesh Bakery',
                'website' => 'shop.mbcake.in',
                'status' => 'active',
                'contact_1' => '9442189007',
                'email_1' => 'mbcakes@gmail.com',
            ]);

            Company::create([
                'code' => 'achammal',
                'name' => 'Sri Achammal Pyrotech',
                'website' => 'sriachammal.ktrack.in',
                'status' => 'active',
                'contact_1' => '8531856635',
                'email_1' => 'sriachammalpyrotech@gmail.com',
            ]);
        }

        // Always ensure any default "aathish" records are cleaned up from database
        Company::where('code', 'aathish')
            ->orWhere('code', 'LIKE', 'aathish%')
            ->delete();
    }
}
