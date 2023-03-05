<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CashAccountModel;
use App\Models\Category;
use App\Models\CompanyModel;
use App\Models\IssuePartsToJobItemsModel;
use App\Models\IssuePartsToJobModel;
use App\Models\JobInformationItemsModel;
use App\Models\JobInformationModel;
use App\Models\PartsModel;
use App\Models\PurchaseInvoiceItemsModel;
use App\Models\SaleInvoiceForJobsModel;
use App\Models\SaleInvoiceItemsModel;
use App\Models\Technician;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomController extends Controller
{

//parts_issue_modal
    public
    function parts_issue_modal_view_details(Request $request)
    {
        $items = IssuePartsToJobItemsModel::where('iptji_id', $request->id)->get();

        return response()->json($items);
    }

    public
    function parts_issue_modal_view_details_SH(Request $request, $id)
    {


        $items = IssuePartsToJobItemsModel::where('iptji_iptj_id', $id)->get();


        $items = DB::table('issue_parts_to_job_items')
            ->leftJoin('parts', 'parts.par_id','=', 'issue_parts_to_job_items.iptji_parts')
            ->where('iptji_iptj_id', $id)
            ->get();

//        return $items;

        $type = 'grid';
        $pge_title = 'Sale Invoice';

        return view('modal_views.parts_issue_modal', compact( 'type', 'pge_title', 'items'));
    }

    public
    function parts_issue_modal_view_details_pdf_SH(Request $request, $id)
    {

        $sim = DB::table('financials_sale_invoice')
            ->join('financials_accounts', 'financials_accounts.account_uid', '=', 'financials_sale_invoice.si_party_code')
            ->where('si_id', $id)
            ->select('financials_accounts.account_urdu_name as si_party_name','si_id','si_party_code','si_customer_name','si_remarks','si_total_items','si_total_price',
                'si_product_disc','si_round_off_disc',
                'si_cash_disc_per','si_cash_disc_amount','si_total_discount','si_inclusive_sales_tax','si_exclusive_sales_tax','si_total_sales_tax','si_grand_total',
                'si_cash_received','si_day_end_id','si_day_end_date','si_createdby','si_sale_person','si_service_invoice_id','si_local_invoice_id','si_local_service_invoice_id','si_cash_received_from_customer','si_return_amount')->first();


        $type = 'pdf';
        $pge_title = 'Sale Invoice';


        $footer = view('invoice_view._partials.pdf_footer')->render();
        $header = view('invoice_view._partials.pdf_header', compact('invoice_nbr', 'invoice_date', 'pge_title', 'type'))->render();
        $options = [
            'footer-html' => $footer,
            'header-html' => $header,
            'margin-top' => 24,
        ];

        $pdf = SnappyPdf::loadView('invoice_view.sale_invoice.sale_invoice_list_modal', compact('siims', 'sim', 'seim', 'nbrOfWrds', 'accnts', 'type', 'pge_title', 'cash_received'));
        $pdf->setOptions($options);

        return $pdf->stream('Sale-Invoice.pdf');
    }



    //sale_job_invoice_modal
    public
    function sale_job_invoice_modal_view_details(Request $request)
    {
        $items = SaleInvoiceForJobsModel::where('sifj_id', $request->id)
            ->leftJoin('job_information', 'job_information.ji_id','=', 'sale_invoice_for_jobs.sifj_job_no')
            ->get();

        return response()->json($items);
    }

    //PDF me Load hony sy pehly
    public
    function sale_job_invoice_modal_view_details_SH(Request $request, $id)
    {

        $company_info = CompanyModel::first();


//    dd(12);
        $items = DB::table('sale_invoice_for_jobs')
            ->leftJoin('job_information', 'job_information.ji_id','=', 'sale_invoice_for_jobs.sifj_job_no')
            ->leftJoin('brands', 'brands.bra_id','=', 'job_information.ji_bra_id')
            ->leftJoin('categories', 'categories.cat_id','=', 'job_information.ji_cat_id')
            ->leftJoin('model_table', 'model_table.mod_id','=', 'job_information.ji_mod_id')
            ->leftJoin('client', 'client.cli_id','=', 'job_information.ji_cli_id')
            ->where('sifj_id', $id)
            ->get();

//        return $items;


        $complain_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', "Complain")
            ->groupBy('jii_ji_id')
            ->get();

        $accessory_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', "Accessory")
            ->groupBy('jii_ji_id')
            ->get();



        $type = 'grid';
        $pge_title = 'Job Sale Invoice';

        return view('modal_views.job_sale_invoice_modal', compact( 'type', 'pge_title', 'items','complain_items','accessory_items','company_info'));
    }

    //PDF me ye code chal rha h
    public
    function sale_job_invoice_modal_view_details_pdf_SH(Request $request, $id)
    {
//        dd(2);
        $company_info = CompanyModel::first();


        $items = DB::table('sale_invoice_for_jobs')
            ->leftJoin('job_information', 'job_information.ji_id','=', 'sale_invoice_for_jobs.sifj_job_no')
            ->leftJoin('brands', 'brands.bra_id','=', 'job_information.ji_bra_id')
            ->leftJoin('categories', 'categories.cat_id','=', 'job_information.ji_cat_id')
            ->leftJoin('model_table', 'model_table.mod_id','=', 'job_information.ji_mod_id')
            ->leftJoin('client', 'client.cli_id','=', 'job_information.ji_cli_id')
            ->where('sifj_id', $id)
            ->get();


        $complain_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', "Complain")
            ->groupBy('jii_ji_id')
            ->get();

        $accessory_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', "Accessory")
            ->groupBy('jii_ji_id')
            ->get();

        $type = 'pdf';
        $pge_title = 'Job Sale Invoice';


//        $footer = view('invoice_view._partials.pdf_footer')->render();
//        $header = view('invoice_view._partials.pdf_header', compact('invoice_nbr', 'invoice_date', 'pge_title', 'type'))->render();
//        $options = [
//            'footer-html' => $footer,
//            'header-html' => $header,
//            'margin-top' => 24,
//        ];

//        $pdf = SnappyPdf::loadView('modal_views.job_sale_invoice_modal', compact( 'items',    'type', 'pge_title','complain_items','accessory_items'));
        $pdf = SnappyPdf::loadView('modal_views.pdf_sale_invoice', compact( 'items',    'type', 'pge_title','complain_items','accessory_items','company_info'));
//        $pdf->setOptions($options);

        return $pdf->stream('Job-Sale-Invoice.pdf');
    }



    //sale_invoice_modal
    public
    function sale_invoice_modal_view_details(Request $request)
    {
        $items = SaleInvoiceItemsModel::where('sii_id', $request->id)
            ->leftJoin('parts', 'parts.par_id','=', 'sale_invoice_items.sii_part_name')
            ->leftJoin('sale_invoice', 'sale_invoice.si_id','=', 'sale_invoice_items.sii_si_id')
            ->get();

        return response()->json($items);
    }

    public
    function sale_invoice_modal_view_details_SH(Request $request, $id)
    {

        $company_info = CompanyModel::first();

        $items = SaleInvoiceItemsModel::where('sii_si_id', $id)->get();


        $items = DB::table('sale_invoice_items')
            ->leftJoin('parts', 'parts.par_id','=', 'sale_invoice_items.sii_part_name')
            ->leftJoin('sale_invoice', 'sale_invoice.si_id','=', 'sale_invoice_items.sii_si_id')
            ->leftJoin('party', 'party.party_id','=', 'sale_invoice.si_party_id')
            ->where('sii_si_id', $id)
            ->get();

//        return $items;

        $type = 'grid';
        $pge_title = 'Sale Invoice';

        return view('modal_views.sale_invoice_modal', compact( 'type', 'pge_title', 'items','company_info'));
    }

    public
    function sale_invoice_modal_view_details_pdf_SH(Request $request, $id)
    {
        $company_info = CompanyModel::first();


        $items = DB::table('sale_invoice_items')
            ->leftJoin('parts', 'parts.par_id','=', 'sale_invoice_items.sii_part_name')
            ->leftJoin('sale_invoice', 'sale_invoice.si_id','=', 'sale_invoice_items.sii_si_id')
            ->leftJoin('party', 'party.party_id','=', 'sale_invoice.si_party_id')

            ->where('sii_si_id', $id)
            ->get();

        $type = 'pdf';
        $pge_title = 'Sale Invoice';


//        $footer = view('invoice_view._partials.pdf_footer')->render();
//        $header = view('invoice_view._partials.pdf_header', compact('invoice_nbr', 'invoice_date', 'pge_title', 'type'))->render();
//        $options = [
//            'footer-html' => $footer,
//            'header-html' => $header,
//            'margin-top' => 24,
//        ];

        $pdf = SnappyPdf::loadView('modal_views.pdf_sale_invoice_modal', compact( 'items',    'type', 'pge_title','company_info'));
//        $pdf->setOptions($options);

        return $pdf->stream('Purchase-Invoice.pdf');
    }



    //purchase_invoice_modal
    public
    function purchase_invoice_modal_view_details(Request $request)
    {
        $items = PurchaseInvoiceItemsModel::where('pii_id', $request->id)
            ->leftJoin('parts', 'parts.par_id','=', 'purchase_invoice_items.pii_part_name')
            ->leftJoin('purchase_invoice', 'purchase_invoice.pi_id','=', 'purchase_invoice_items.pii_pi_id')
            ->get();

        return response()->json($items);
    }

    public
    function purchase_invoice_modal_view_details_SH(Request $request, $id)
    {

        $company_info = CompanyModel::first();

        $items = PurchaseInvoiceItemsModel::where('pii_pi_id', $id)->get();


        $items = DB::table('purchase_invoice_items')
            ->leftJoin('parts', 'parts.par_id','=', 'purchase_invoice_items.pii_part_name')
            ->leftJoin('purchase_invoice', 'purchase_invoice.pi_id','=', 'purchase_invoice_items.pii_pi_id')
            ->leftJoin('party', 'party.party_id','=', 'purchase_invoice.pi_party_id')

            ->where('pii_pi_id', $id)
            ->get();

//        return $items;

        $type = 'grid';
        $pge_title = 'Purchase Invoice';

        return view('modal_views.purchase_invoice_modal', compact( 'type', 'pge_title', 'items','company_info'));
    }

    public
    function purchase_invoice_modal_view_details_pdf_SH(Request $request, $id)
    {
        $company_info = CompanyModel::first();

        $items = DB::table('purchase_invoice_items')
            ->leftJoin('parts', 'parts.par_id','=', 'purchase_invoice_items.pii_part_name')
            ->leftJoin('purchase_invoice', 'purchase_invoice.pi_id','=', 'purchase_invoice_items.pii_pi_id')
            ->leftJoin('party', 'party.party_id','=', 'purchase_invoice.pi_party_id')

            ->where('pii_pi_id', $id)
            ->get();


        $type = 'pdf';
        $pge_title = 'Sale Invoice';


//        $footer = view('invoice_view._partials.pdf_footer')->render();
//        $header = view('invoice_view._partials.pdf_header', compact( 'pge_title', 'type'))->render();
//        $options = [
//            'footer-html' => $footer,
//            'header-html' => $header,
//            'margin-top' => 24,
//        ];

        $pdf = SnappyPdf::loadView('modal_views.pdf_purchase_invoice_modal', compact( 'items',    'type', 'pge_title','company_info'));
//        $pdf->setOptions($options);

        return $pdf->stream('Purchase-Invoice.pdf');
    }



    //Job Information modal
    public
    function job_info_modal_view_details(Request $request)
    {
        $items = JobInformationModel::where('ji_id', $request->id)
            ->leftJoin('job_information_items', 'job_information_items.jii_ji_id','=', 'job_information.ji_id')
            ->get();

        return response()->json($items);
    }

    //PDF me Load hony sy pehly
    public
    function job_info_modal_view_details_SH(Request $request, $id)
    {

        $company_info = CompanyModel::first();

//    dd(12);
        $items = DB::table('job_information')
            ->leftJoin('brands', 'brands.bra_id','=', 'job_information.ji_bra_id')
            ->leftJoin('categories', 'categories.cat_id','=', 'job_information.ji_cat_id')
            ->leftJoin('model_table', 'model_table.mod_id','=', 'job_information.ji_mod_id')
            ->leftJoin('client', 'client.cli_id','=', 'job_information.ji_cli_id')
            ->where('ji_id', $id)
            ->get();

//        return $items;


        $complain_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', "Complain")
            ->groupBy('jii_ji_id')
            ->get();

        $accessory_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', "Accessory")
            ->groupBy('jii_ji_id')
            ->get();



        $type = 'grid';
        $pge_title = 'Job Information Invoice';

        return view('modal_views.job_info_modal', compact( 'type', 'pge_title', 'items','complain_items','accessory_items','company_info'));
    }

    //PDF me ye code chal rha h
    public
    function job_info_modal_view_details_pdf_SH(Request $request, $id)
    {
//        dd(2);
        $company_info = CompanyModel::first();

//        dd($company_info->com_name);

        $items = DB::table('job_information')
            ->leftJoin('brands', 'brands.bra_id','=', 'job_information.ji_bra_id')
            ->leftJoin('categories', 'categories.cat_id','=', 'job_information.ji_cat_id')
            ->leftJoin('model_table', 'model_table.mod_id','=', 'job_information.ji_mod_id')
            ->leftJoin('client', 'client.cli_id','=', 'job_information.ji_cli_id')
            ->where('ji_id', $id)
            ->get();


        $complain_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', "Complain")
            ->groupBy('jii_ji_id')
            ->get();

        $accessory_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', "Accessory")
            ->groupBy('jii_ji_id')
            ->get();

        $type = 'pdf';
        $pge_title = 'Job Information Invoice';


//        $footer = view('invoice_view._partials.pdf_footer')->render();
//        $header = view('invoice_view._partials.pdf_header', compact('invoice_nbr', 'invoice_date', 'pge_title', 'type'))->render();
//        $options = [
//            'footer-html' => $footer,
//            'header-html' => $header,
//            'margin-top' => 24,
//        ];

//        $pdf = SnappyPdf::loadView('modal_views.job_sale_invoice_modal', compact( 'items',    'type', 'pge_title','complain_items','accessory_items'));
        $pdf = SnappyPdf::loadView('modal_views.pdf_job_info_modal', compact( 'items',    'type', 'pge_title','complain_items','accessory_items',"company_info"));
//        $pdf->setOptions($options);

        return $pdf->stream('Job-Information-Invoice.pdf');
    }




//    for ajax

    public function get_estimate(Request $request)
    {
        $bra_name_id = $request->bra_name_id;

        $cats = JobInformationModel::select("ji_estimated_cost")->where('ji_id', $bra_name_id)->get();

        return response()->json($cats);
    }

    public function get_rate(Request $request)
    {
        $bra_name_id = $request->bra_name_id;

        $cats = PartsModel::where('par_id', $bra_name_id)->get();

        return response()->json($cats);
    }


    public function get_estimate_for_sale(Request $request)
    {

        $job_id = $request->job_id;


        $cats = DB::table('job_information')
            ->leftJoin('vendor', 'vendor.vendor_id','=', 'job_information.ji_vendor')
            ->where('ji_id', $job_id)
            ->get();



//        $cats = JobInformationModel::where('ji_id', $job_id)->get();

        return response()->json($cats);
    }


    public function get_stock_qty(Request $request)
    {
        $part_id = $request->part_id;

        $cats = PartsModel::select('par_total_qty')->where('par_id', $part_id)->get();

        return response()->json($cats);
    }

    public function get_data_job_info(Request $request){
        $job_id = $request->job_id;
        $data = JobInformationItemsModel::where('jii_ji_id',$job_id)->get();

//        $complain = $data->where('jii_status','=','Accessory')->get();

        return response()->json($data);
    }


    public function get_account_total(Request $request){
        $account_id = $request->account_id;

//        dd($request->account_id);

        $data = CashAccountModel::where('ca_id',$account_id)->get();

//        $complain = $data->where('jii_status','=','Accessory')->get();

        return response()->json($data);
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////     Json Product     //////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////
    public function get_technision(Request $request)
    {
        $products = JobInformationModel::where("ji_job_status","=","Pending")->get();

//        $products = Technician::where("status",'=','1')->where("tech_status",'=','1')->get();
        return json_encode($products);

        $products = json_encode($products);

        return response()->json(json_encode($products));
    }


    public function get_brand(Request $request)
    {
        $brands = Brand::all();

//        $products = Technician::where("status",'=','1')->where("tech_status",'=','1')->get();
        return json_encode($brands);

        $brands = json_encode($brands);

        return response()->json(json_encode($brands));
    }


//    public function get_category(Request $request)
//    {
//        $categories = Category::all();
//
////        $products = Technician::where("status",'=','1')->where("tech_status",'=','1')->get();
//        return json_encode($categories);
//
//        $categories = json_encode($categories);
//
//        return response()->json(json_encode($categories));
//    }


}
