<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Array_;

class CartController extends Controller
{
    //

    /**
     * Shows all items in the cart.
     *
     * @return Response
     */
    public function list()
    {
      if (!Auth::check()) return redirect('/login');

      //$this->authorize('list', Card::class);
			
			$items = array();
      $items = Auth::user()->cart_items()->orderBy('date_added')->get();
			
			$pictures = array();
			foreach ($items as $item) {
				array_push($pictures, $item->images()->get()->first());
			}
			//return  ['items' => $items, 'pictures' => $pictures];
			//return $items;	
	

			return view('pages.cart', ['items' => $items, 'pictures' => $pictures]);
		}

		/**
     * Add an item to the cart.
     *
     * @return Response
     */
		public function add_to_cart(Request $request) {
      
      if (!Auth::check()) return redirect('/login');

      $item = $request->input('id_item');
      $quantity = $request->input('quantity');

      $cart = Auth::user()->cart_items();

      $cart->attach(1, ['id_user' => Auth::user()->id, 'id_item' => $item, 'quantity' => $quantity]);

      $item = Auth::user()->cart_items()->orderBy('date_added', 'desc')->first();
      $picture = $item->images()->get()->first();

      return ['item' => $item, 'picture' => $picture];
    }
    
    public function delete_from_cart(Request $request) {
      if (!Auth::check()) return redirect('/login');

      $item = $request->input('id_item');

      $cart = Auth::user()->cart_items();

      $cart->detach(['id_user' => Auth::user()->id, 'id_item' => $item]);
      
      $items = Auth::user()->cart_items()->orderBy('date_added')->get();
      return $items;
    }

    public function update_item_quantity(Request $request) {
      if (!Auth::check()) return redirect('/login');

      $item = $request->input('id_item');
      $quantity = $request->input('quantity');

      $cart = Auth::user()->cart_items();
      $cart->updateExistingPivot(['id_user' => Auth::user()->id, 'id_item' => $item], ['quantity' => $quantity]);

      $items = Auth::user()->cart_items()->orderBy('date_added')->get();

      return $items;
    }
}