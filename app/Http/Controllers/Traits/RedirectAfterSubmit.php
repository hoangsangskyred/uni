<?php
namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

trait RedirectAfterSubmit {

    public function setRedirectLink(Request $request)
    {
        session([$this->name . '_redirect' => $request->fullUrl()]);
    }

    public function getRedirectLink(): string
    {
        return session($this->name . '_redirect', route($this->name . '.index'));
    }

}
