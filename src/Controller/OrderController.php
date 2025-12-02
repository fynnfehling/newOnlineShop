<?php
declare(strict_types=1);
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Services\Mailer;

class OrderController extends AbstractController
{
    #[Route('/api/order/submit', name: 'api_order_submit', methods: ['POST'])]
    public function submitOrder(Request $request, Mailer $mailService): JsonResponse
    {
        $data = json_decode($request->getContent(), associative: true);
        if (empty($data['email']) || empty($data['quantity'])) {
            return new JsonResponse(['status' => 'error', 'message' => 'Missing data'], 400);
        }
        $requiredKeys = ['name', 'quantity', 'totalAmount', 'streetName', 'houseNumber', 'zip', 'city', 'country'];
        foreach ($requiredKeys as $key) {
            if (!isset($data[$key])) {
                $data[$key] = '';
            }
        }
        $mailService->sendOrderConfirmation(
            (string)$data['email'],
            $data
        );
        return new JsonResponse(['status' => 'success', 'message' => 'Order submitted and email sent'], 200);
    }
}
