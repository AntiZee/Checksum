<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function search(Request $r)
    {
        if ($r->ajax()) {

            $data = Certificate::where('id', 'like', '%' . $r->search . '%')
                ->orwhere('title', 'like', '%' . $r->search . '%')
                ->orwhere('description', 'like', '%' . $r->search . '%')->get();


            $output = '';
            if (count($data) > 0) {

                $output = '
                <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                </tr>
                </thead>
                <tbody>';

                foreach ($data as $row) {
                    $output .= '
                        <tr>
                        <th scope="row">' . $row->id . '</th>
                        <td>' . $row->title . '</td>
                        <td>' . $row->description . '</td>
                        </tr>
                        ';
                }



                $output .= '
                 </tbody>
                </table>';
            } else {

                $output .= 'No results';
            }

            return $output;
        }
    }
}
