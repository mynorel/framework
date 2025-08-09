<?php
namespace Mynorel\Http;

use Mynorel\Narrative\Narrative;
use Mynorel\Prelude\Prelude;
use Mynorel\Myneral\Myneral;

class Dispatcher
{
    /**
     * Dispatch the request to the appropriate chapter/scene and return a Response.
     * @param Request $request
     * @return Response
     */
    public static function dispatch(Request $request): Response
    {
        $path = trim($request->path(), '/');
        $chapter = Narrative::find($path);
        if (!$chapter) {
            return new Response('Not Found', 404);
        }
        // Run middleware (Prelude)
        if (!empty($chapter->middleware)) {
            Prelude::run($chapter->middleware, ['chapter' => $chapter->name, 'user' => $request->user()]);
        }
        // Invoke scene/controller
        if ($chapter->controller && class_exists($chapter->controller)) {
            $scene = new $chapter->controller();
            if (is_callable($scene)) {
                $result = $scene($request);
                if ($result instanceof Response) {
                    return $result;
                }
                // Render via Myneral if string/template
                if (is_string($result)) {
                    $content = Myneral::render($result, ['user' => $request->user()]);
                    return new Response($content);
                }
            }
        }
        return new Response('No scene found', 404);
    }
}
