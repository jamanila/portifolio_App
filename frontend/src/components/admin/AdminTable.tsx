import type { ReactNode } from 'react'
import { FaPen, FaTrash } from 'react-icons/fa6'

export interface AdminColumn<T> {
  header: string
  render: (row: T) => ReactNode
  className?: string
}

interface AdminTableProps<T extends { id: number }> {
  columns: AdminColumn<T>[]
  rows: T[]
  isLoading?: boolean
  onEdit?: (row: T) => void
  onDelete?: (row: T) => void
  emptyMessage?: string
}

export default function AdminTable<T extends { id: number }>({
  columns,
  rows,
  isLoading,
  onEdit,
  onDelete,
  emptyMessage = 'No records yet.',
}: AdminTableProps<T>) {
  return (
    <div className="overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-800">
      <table className="w-full min-w-[640px] text-left text-sm">
        <thead className="bg-neutral-50 text-xs uppercase tracking-wide text-neutral-500 dark:bg-neutral-900 dark:text-neutral-400">
          <tr>
            {columns.map((col) => (
              <th key={col.header} className={`px-4 py-3 font-semibold ${col.className ?? ''}`}>
                {col.header}
              </th>
            ))}
            {(onEdit || onDelete) && <th className="px-4 py-3 text-right font-semibold">Actions</th>}
          </tr>
        </thead>
        <tbody className="divide-y divide-neutral-200 bg-white dark:divide-neutral-800 dark:bg-neutral-900">
          {isLoading ? (
            <tr>
              <td colSpan={columns.length + 1} className="px-4 py-8 text-center text-neutral-400">
                Loading…
              </td>
            </tr>
          ) : rows.length === 0 ? (
            <tr>
              <td colSpan={columns.length + 1} className="px-4 py-8 text-center text-neutral-400">
                {emptyMessage}
              </td>
            </tr>
          ) : (
            rows.map((row) => (
              <tr key={row.id} className="text-neutral-700 dark:text-neutral-300">
                {columns.map((col) => (
                  <td key={col.header} className={`px-4 py-3 ${col.className ?? ''}`}>
                    {col.render(row)}
                  </td>
                ))}
                {(onEdit || onDelete) && (
                  <td className="px-4 py-3 text-right">
                    <div className="flex justify-end gap-2">
                      {onEdit && (
                        <button
                          type="button"
                          onClick={() => onEdit(row)}
                          aria-label="Edit"
                          className="flex h-10 w-10 items-center justify-center rounded-lg text-neutral-500 hover:bg-neutral-100 hover:text-indigo-600 dark:text-neutral-400 dark:hover:bg-neutral-800 dark:hover:text-indigo-400"
                        >
                          <FaPen size={14} />
                        </button>
                      )}
                      {onDelete && (
                        <button
                          type="button"
                          onClick={() => onDelete(row)}
                          aria-label="Delete"
                          className="flex h-10 w-10 items-center justify-center rounded-lg text-neutral-500 hover:bg-red-50 hover:text-red-600 dark:text-neutral-400 dark:hover:bg-red-500/10 dark:hover:text-red-400"
                        >
                          <FaTrash size={14} />
                        </button>
                      )}
                    </div>
                  </td>
                )}
              </tr>
            ))
          )}
        </tbody>
      </table>
    </div>
  )
}
