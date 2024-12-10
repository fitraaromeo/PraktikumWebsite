<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioResource;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index()
    {
        $portfolios = Portfolio::latest()->paginate(5);

        return new PortfolioResource(true, 'List Data Portfolio', $portfolios);
    }

    /**
     * store
     * 
     * @param mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'link'  => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $portfolio = Portfolio::create([
            'title' => $request->title,
            'link' => $request->link,
            'description' => $request->description,
        ]);

        return new PortfolioResource(true, 'Data Portfolio Berhasil di tambahkan!', $portfolio);
    }

    /**
     * show
     * 
     * @param mixed $id
     * @return void
     */
    public function show($id)
    {
        $portfolio = Portfolio::find($id);

        return new PortfolioResource(true, 'Detail Data Portfolio!', $portfolio);
    }

    /**
     * update
     * 
     * @param mixed $request
     * @param mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'=> 'required',
            'link' =>  'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $portfolio =  Portfolio::find($id);

        $portfolio->update([
            'title' => $request->title,
            'link' => $request->link,
            'description' => $request->description,
        ]);

        return new PortfolioResource(true, 'Data Portfolio Berhasil di Ubah', $portfolio);
    }

    /**
     * destroy
     * 
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::find($id);

        $portfolio->delete();

        return new PortfolioResource(true, 'Portfolio berhasil di hapus!', null);
    }
}
