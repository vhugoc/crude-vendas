<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Libraries\Helpers;
use App\Models\Sale;
use App\Models\User;

class SaleController extends Controller {

  /**
   * Show a list of sales
   *
   * @param  Request $request
   * @return Response
   */
  public function index(Request $request) {
    try {
      if (!isset($request->days)) {
        return response()->json(Sale::where('user_id', '=', $request->token->id)->orderBy('date', 'DESC')->get());
      } else {
        $start_date = Helpers::adjustDate(Helpers::generateDate("Y-m-d"), "-$request->days days");
        return response()->json(
          Sale::where('user_id', '=', $request->token->id)
          ->whereDate('date', '>=', $start_date)
          ->orderBy('date', 'DESC')
          ->get()
        );
      }
    } catch (Exception $err) {
      return $err;
    }
  }

  /**
   * Show a sale by id
   *
   * @param  Request $request
   * @param int $id
   * @return Response
   */
  public function show(Request $request, $id) {
    try {
      return response()->json(Sale::where([
        ['user_id', '=', $request->token->id],
        ['id', '=', $request->id]
      ])->get()->first());
    } catch (Exception $err) {
      return $err;
    }
  }

  /**
   * Add a sale
   * 
   * @param Request $request
   * @return Response
   */
  public function add(Request $request) {
    try {

      /**
       * Data Validation
       * 
       */
      $this->validate($request, [
        'description' => ['required', 'string'],
        'source'      => ['required', 'string'],
        'value'       => ['required', 'numeric'],
        'date'        => ['required', 'date']
      ]);

      if (!Helpers::validateDate($request->date, 'Y/m/d')) {
        return response()->json([
          "success"   => false,
          "message"   => "invalid date format"
        ]);
      }

      if ($request->date > Helpers::generateDate('Y/m/d')) {
        return response()->json([
          "success"   => false,
          "message"   => "Date cannot be greater than today"
        ]);
      }

      $sale = new Sale();

      $sale->user_id = $request->token->id;
      $sale->description = $request->description;
      $sale->source = $request->source;
      $sale->value = $request->value;
      $sale->date = $request->date;

      $add = $sale->save();

      if (!$add) {
        return response()->json([
          "success"   => false,
          "message"   => "error"
        ]);
      }

      return response()->json([
        "success"   => true,
        "sale"      => $sale
      ]);

    } catch (Exception $err) {
      return $err;
    }
  }

  /**
   * Update a sale
   * 
   * @param Request $request
   * @param int $id
   * @return Response
   */
  public function update(Request $request, $id) {
    try {

      /**
       * Data Validation
       * 
       */
      $this->validate($request, [
        'description' => ['required', 'string'],
        'source'      => ['required', 'string'],
        'value'       => ['required', 'numeric'],
        'date'        => ['required', 'date']
      ]);

      if (!Helpers::validateDate($request->date, 'Y/m/d')) {
        return response()->json([
          "success"   => false,
          "message"   => "invalid date format"
        ]);
      }

      if ($request->date > Helpers::generateDate('Y/m/d')) {
        return response()->json([
          "success"   => false,
          "message"   => "Date cannot be greater than today"
        ]);
      }

      $sale = Sale::where([
        ['id', '=', $id],
        ['user_id', '=', $request->token->id]
      ])->get()->first();

      if (!$sale) {
        return response()->json([
          "success"   => false,
          "message"   => "This sale does not exists"
        ]);
      }

      $sale->description = $request->description;
      $sale->source = $request->source;
      $sale->value = $request->value;
      $sale->date = $request->date;

      $sale->save();

      return response()->json([
        "success"   => true,
        "sale"      => $sale
      ]);

    } catch (Exception $err) {
      return $err;
    }
  }

  /**
   * Delete a sale
   * 
   * @param Request $request
   * @param int $id
   * @return Response
   */
  public function delete(Request $request, $id) {
    try {

      $sale = Sale::where([
        ['id', '=', $id],
        ['user_id', '=', $request->token->id]
      ])->get()->first();
      
      if (!$sale) {
        return response()->json([
          "success"   => false,
          "message"   => "This sale does not exists"
        ]);
      }

      $sale->delete();

      return response()->json([
        "success"   => true
      ]);

    } catch (Exception $err) {
      return $err;
    }
  }
}
