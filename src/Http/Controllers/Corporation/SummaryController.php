<?php

/*
 * This file is part of SeAT
 *
 * Copyright (C) 2015 to 2020 Leon Jacobs
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

namespace Seat\Web\Http\Controllers\Corporation;

use Seat\Eveapi\Models\Corporation\CorporationInfo;
use Seat\Services\Repositories\Corporation\Corporation;
use Seat\Services\Repositories\Corporation\Divisions;
use Seat\Services\Repositories\Corporation\Wallet;
use Seat\Web\Http\Controllers\Controller;

class SummaryController extends Controller
{
    use Corporation;
    use Divisions;
    use Wallet;

    /**
     * @param \Seat\Eveapi\Models\Corporation\CorporationInfo $corporation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(CorporationInfo $corporation)
    {

        $sheet = $this->getCorporationSheet($corporation->corporation_id);

        // Check if we managed to get any records for
        // this character. If not, redirect back with
        // an error.
        if (empty($sheet))
            return redirect()->back()
                ->with('error', trans('web::seat.unknown_corporation'));

        $asset_divisions = $this->getCorporationDivisions($corporation->corporation_id);
        $wallet_divisions = $this->getCorporationWalletDivisions($corporation->corporation_id);

        return view('web::corporation.summary',
            compact('corporation', 'sheet', 'asset_divisions', 'wallet_divisions'));

    }
}
