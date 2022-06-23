<?php

namespace BTAL\XYZ\ABC\Http\Controllers\Api;

use BTAL\XYZ\ABC\Models\Hello;

use BTAL\XYZ\ABC\Http\Requests\HelloRequest;

use BTAL\XYZ\ABC\Http\Controllers\Api\ABCApiController;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Exception;

class HelloApiController extends ABCApiController
{
    public function index()
    {
        $hellos  =   Hello::orderBy('id', 'DESC')->get();

        $columns   =   $this->prepareColumnsMap(new Hello());

        $this->prepareResponse(true, 'Hello(s) have been retrieved successfully!');

        $this->res['data']     =   $hellos;
        $this->res['columns']  =   $columns;

        return response()->json($this->res);
    }

    public function store(HelloRequest $request)
    {
        try
        {
            $validated     =   $request->validated();

            $hello    =   new Hello;

            $columns           =   $hello->getTableColumns();
            $mutableColumns    =   $this->processMutableColumns($columns);

            foreach($mutableColumns as $mutableColumn)
            {
                $hello->$mutableColumn   =   $request->input($mutableColumn);
            }
            
            $hello->save();
            
            $this->prepareResponse(true, 'Hello has been created successfully!');

            $this->res['data']     =   $hello;

            return response()->json($this->res);
        }
        catch (Exception $th)
        {
            return response()->json($this->prepareResponse(false, $th->getMessage()));
        }
        catch (QueryException $th)
        {
            return response()->json($this->prepareResponse(false, $th->getMessage()));
        }
    }

    public function view($id)
    {
        try
        {
            $hello    =   Hello::findOrFail($id);

            $this->prepareResponse(true, 'Hello has been retrieved successfully!');

            $this->res['data']     =   $hello;

            return response()->json($this->res);
        }
        catch (Exception $th)
        {
            return response()->json($this->prepareResponse(false, $th->getMessage()));
        }
        catch (QueryException $th)
        {
            return response()->json($this->prepareResponse(false, $th->getMessage()));
        }
    }

    public function edit($id)
    {
        try
        {
            $hello    =   Hello::findOrFail($id);

            $this->prepareResponse(true, 'Hello has been retrieved successfully!');

            $this->res['data']     =   $hello;

            return response()->json($this->res);
        }
        catch (Exception $th)
        {
            return response()->json($this->prepareResponse(false, $th->getMessage()));
        }
        catch (QueryException $th)
        {
            return response()->json($this->prepareResponse(false, $th->getMessage()));
        }
    }

    public function update(HelloRequest $request, $id)
    {
        try
        {
            $validated     =   $request->validated();

            $hello    =   Hello::findOrFail($id);

            $columns           =   $hello->getTableColumns();
            $mutableColumns    =   $this->processMutableColumns($columns);
            
            foreach($mutableColumns as $mutableColumn)
            {
                $hello->$mutableColumn   =   $request->input($mutableColumn);
            }
            
            $hello->save();
            
            $this->prepareResponse(true, 'Hello has been updated successfully!');

            $this->res['data']                 =   $hello;

            return response()->json($this->res);
        }
        catch (Exception $th)
        {
            return response()->json($this->prepareResponse(false, $th->getMessage()));
        }
        catch (QueryException $th)
        {
            return response()->json($this->prepareResponse(false, $th->getMessage()));
        }
    }

    public function delete($id)
    {
        try
        {
            $hello    =   Hello::findOrFail($id); // Required If History Is Enabled

            $columns   =   $hello->getTableColumns();
            
            
            $hello->delete();

            return response()->json($this->prepareResponse(true, 'Hello has been deleted successfully!'));
        }
        catch (Exception $th)
        {
            return response()->json($this->prepareResponse(false, $th->getMessage()));
        }
        catch (QueryException $th)
        {
            return response()->json($this->prepareResponse(false, $th->getMessage()));
        }
    }
}
