<?php

namespace App\Http\Controllers;

use App\Models\AuditionSetting;
use App\Models\AuditionContent;
use Illuminate\Contracts\View\View;
// use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(): View
    {
        return view('home');
    }

    public function audition(): View
    {
        $setting = AuditionSetting::query()->first();
        $auditionStart = $setting?->audition_start;
        $auditionEnd = $setting?->audition_end;

        $timeline = AuditionContent::active()->byType('timeline')->orderBy('sort_order')->get();
        $requirements = AuditionContent::active()->byType('requirement')->orderBy('sort_order')->get();
        $benefits = AuditionContent::active()->byType('benefit')->orderBy('sort_order')->get();
        $contactLinks = AuditionContent::active()->byType('contact_link')->orderBy('sort_order')->get();
        $aboutCards = AuditionContent::active()->byType('about_card')->orderBy('sort_order')->get();

        $isRegistrationOpen = $auditionStart && $auditionEnd
            ? now() >= $auditionStart && now() <= $auditionEnd
            : false;

        return view('audition.index', compact(
            'setting', 'auditionStart', 'auditionEnd',
            'timeline', 'requirements', 'benefits', 'contactLinks', 'aboutCards',
            'isRegistrationOpen'
        ));
    }

    public function auditionForm(): View
    {
        $formUrl = AuditionSetting::query()->first()?->form_url;
        return view('audition.form', compact('formUrl'));
    }
}
