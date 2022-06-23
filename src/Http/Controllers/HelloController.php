<?php

namespace BTAL\XYZ\ABC\Http\Controllers;

use BTAL\XYZ\ABC\Models\Hello;

use BTAL\XYZ\ABC\Http\Requests\HelloRequest;

use BTAL\XYZ\ABC\Http\Controllers\ABCController;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Exception;

class HelloController extends ABCController
{
    public function index()
    {
        $hellos  =   Hello::orderBy('id', 'DESC')->paginate(25);

        $columns   =   $this->prepareColumnsMap(new Hello());

        return view('abc::hello.index', compact('hellos', 'columns'));
    }

    public function create()
    {
        return view('abc::hello.create');
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
            
            return redirect()
                        ->route('hellos.index')
                        ->withMessage('Hello has been created successfully!');
        }
        catch (Exception $th)
        {
            return redirect()
                        ->route('hellos.create')
                        ->withErrors($th->getMessage());
        }
        catch (QueryException $th)
        {
            return redirect()
                        ->route('hellos.create')
                        ->withErrors($th->getMessage());
        }
    }

    public function view($id)
    {   
        try
        {
            $hello        =   Hello::findOrFail($id);

            return view('abc::hello.view', compact('hello'));
        }
        catch (Exception $th)
        {
            return redirect()
                        ->route('hellos.index')
                        ->withErrors($th->getMessage());
        }
        catch (QueryException $th)
        {
            return redirect()
                        ->route('hellos.index')
                        ->withErrors($th->getMessage());
        }
    }

    public function edit($id)
    {
        try
        {
            $hello        =   Hello::findOrFail($id);

            return view('abc::hello.edit', compact('hello'));
        }
        catch (Exception $th)
        {
            return redirect()
                        ->route('hellos.index')
                        ->withErrors($th->getMessage());
        }
        catch (QueryException $th)
        {
            return redirect()
                        ->route('hellos.index')
                        ->withErrors($th->getMessage());
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
            
            return redirect()
                ->route('hellos.index')
                ->withMessage('Hello has been updated successfully!');
        }
        catch (Exception $th)
        {
            return redirect()
                        ->route('hellos.edit', $id)
                        ->withErrors($th->getMessage());
        }
        catch (QueryException $th)
        {
            return redirect()
                        ->route('hellos.edit', $id)
                        ->withErrors($th->getMessage());
        }
    }

    public function delete($id)
    {
        try
        {
            $hello    =   Hello::findOrFail($id);

            $columns   =   $hello->getTableColumns(); // Required If History Is Enabled
            
            
            $hello->delete();

            return redirect()
                        ->route('hellos.index')
                        ->withMessage('Hello has been deleted successfully!');
        }
        catch (Exception $th)
        {
            return redirect()
                        ->route('hellos.index')
                        ->withErrors($th->getMessage());
        }
        catch (QueryException $th)
        {
            return redirect()
                        ->route('hellos.index')
                        ->withErrors($th->getMessage());
        }
    }
}
