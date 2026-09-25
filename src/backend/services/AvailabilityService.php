<?php
// AvailabilityService — модуль контроля доступности (нетиповая особенность).
// Проверяет «на лету», не пересекается ли интервал с существующими бронями,
// чтобы не допустить двойного бронирования одного места.
class AvailabilityService
{
    public function __construct(private BookingRepository $bookings) {}

    public function isAvailable(int $workplaceId, string $start, string $end): bool
    {
        // Интервалы пересекаются, если start_at < новый_end И end_at > новый_start
        return count($this->bookings->findOverlapping($workplaceId, $start, $end)) === 0;
    }
}
