<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     description="Made with ❤ by citiasia.",
 *     version="1.0.0",
 *     title="API Documentation",
 *     termsOfService="http://swagger.io/terms/",
 *     @OA\Contact(
 *         email="dev@citiasiainc.id"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * )
 */
abstract class Controller
{

}
