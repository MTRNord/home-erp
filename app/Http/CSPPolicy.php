<?php
namespace App\Http;

use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policies\Basic;
use Spatie\Csp\Scheme;

class CSPPolicy extends Basic
{
    public function configure()
    {
        parent::configure();

        $this->addDirective(Directive::SCRIPT, Keyword::UNSAFE_EVAL)
            ->addDirective(Directive::STYLE, Keyword::UNSAFE_INLINE)
            ->addDirective(Directive::CONNECT, Scheme::WSS)
            ->addDirective(Directive::CONNECT, Scheme::WS)
            ->addDirective(Directive::IMG, Scheme::DATA);

        if (app()->environment() === 'local') {
            $this
                ->addDirective(Directive::SCRIPT, Keyword::UNSAFE_INLINE);
        }
    }
}
