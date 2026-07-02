<?php

namespace App\Services;

use App\Models\ContactMessage;
use App\Repositories\Contracts\ContactMessageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ContactMessageService
{
    public function __construct(private ContactMessageRepositoryInterface $repository) {}

    public function list(): Collection
    {
        return $this->repository->all();
    }

    public function unread(): Collection
    {
        return $this->repository->unread();
    }

    public function submit(array $data): ContactMessage
    {
        return $this->repository->create([...$data, 'is_read' => false]);
    }

    public function markAsRead(ContactMessage $message): ContactMessage
    {
        return $this->repository->update($message, ['is_read' => true]);
    }

    public function delete(ContactMessage $message): bool
    {
        return $this->repository->delete($message);
    }
}
