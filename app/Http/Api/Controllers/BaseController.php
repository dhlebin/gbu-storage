<?php

namespace App\Http\Api\Controllers;

use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;

/**
 * @SWG\Swagger(
 *     schemes={"http"},
 *     host="depot.esmc.info",
 *     basePath="/api/v1",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Storage API",
 *         description="This is documentation for API",
 *         @SWG\Contact(
 *             email="apiteam@wordnik.com"
 *         ),
 *         @SWG\License(
 *             name="Apache 2.0",
 *             url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *         )
 *     ),
 *     @SWG\ExternalDocumentation(
 *         description="Find out more about Swagger",
 *         url="http://swagger.io"
 *     )
 * )
 */

class BaseController extends Controller
{
    use Helpers;

	function healthCheck() {
		$response = new Response(null);

		return $response->setStatusCode(200);
	}
}