<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    function search(Request $r)
    {
        if ($r->ajax()) {
            $userid = Auth::user()->id;
            $result = '';
            $query = $r->search;
            if (empty($query)) {
                $data = Certificate::where('user_id', $userid)->get();
                if ($data->isEmpty()) {
                    $result .= '<tr><td colspan="4">No Data</td></tr>';
                } else {
                    foreach ($data as $row) {
                        $result .= '
                            <tr>
                                <td>' . $row->name . '</td>
                                <td>' . $row->time . '</td>
                                <td>' . $row->sha512 . '</td>
                                <td><a href="'. Storage::url($row->file_path) .'" download><button>Download</button></a></td>
                            </tr>
                        ';
                    }
                }
            } else {
                $data = Certificate::where('sha512', '=', $r->search)->get();
                if ($data->isEmpty()) {
                    $result .= '<tr><td colspan="3">No Results</td></tr>';
                } else {
                    foreach ($data as $row) {
                        $result .= '
                        <tr>
                            <td>' . $row->name . '</td>
                            <td>' . $row->time . '</td>
                            <td>' . $row->sha512 . '</td>
                            <td><a href="'. Storage::url($row->file_path) .'" download><button>Download</button></a></td>
                        </tr>
                    ';
                    }
                }
            }
            return $result;
        }
    }
}