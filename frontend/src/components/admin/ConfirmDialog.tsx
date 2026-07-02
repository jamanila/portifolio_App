import Modal from './Modal'

interface ConfirmDialogProps {
  isOpen: boolean
  title: string
  message: string
  onConfirm: () => void
  onCancel: () => void
  isLoading?: boolean
}

export default function ConfirmDialog({ isOpen, title, message, onConfirm, onCancel, isLoading }: ConfirmDialogProps) {
  return (
    <Modal isOpen={isOpen} onClose={onCancel} title={title}>
      <p className="text-sm text-neutral-600 dark:text-neutral-400">{message}</p>
      <div className="mt-6 flex justify-end gap-3">
        <button
          type="button"
          onClick={onCancel}
          className="rounded-full border border-neutral-300 px-5 py-2 text-sm font-medium text-neutral-700 hover:bg-neutral-100 dark:border-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-800"
        >
          Cancel
        </button>
        <button
          type="button"
          onClick={onConfirm}
          disabled={isLoading}
          className="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white hover:bg-red-500 disabled:opacity-60"
        >
          {isLoading ? 'Deleting…' : 'Delete'}
        </button>
      </div>
    </Modal>
  )
}
