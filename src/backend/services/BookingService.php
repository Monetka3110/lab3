<?php
// BookingService — бизнес-логика бронирования
class BookingService
{
    public function __construct(
        private BookingRepository $bookings,
        private AvailabilityService $availability
    ) {}

    public function createBooking(int $userId, int $workplaceId, string $start, string $end): array
    {
        $pdo = db();
        $pdo->beginTransaction();
        if (!$this->availability->isAvailable($workplaceId, $start, $end)) {
            $pdo->rollBack();
            throw new RuntimeException('Место уже занято на это время', 409);
        }
        // TODO: $this->bookings->save(...)
        $pdo->commit();
        return [];
    }
}
