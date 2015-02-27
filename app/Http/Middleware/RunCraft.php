<?php namespace App\Http\Middleware;

use Closure;
use Craft\WebApp as CraftWebApp;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RunCraft {

    protected $craftWebApp;

    public function __construct(CraftWebApp $craftWebApp) {
        $this->craftWebApp = $craftWebApp;
    }

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if( $this->shouldRunCraft($request) ) {
            $this->craftWebApp->run();
        }

		try {
            return $next($request);
        } catch( NotFoundHttpException $e) {
            $this->craftWebApp->run();
        }
	}

    private function shouldRunCraft($request) {
        return $request->has('p');
    }

}
