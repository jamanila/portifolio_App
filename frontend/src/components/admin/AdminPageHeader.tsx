import { FaPlus } from 'react-icons/fa6'

interface AdminPageHeaderProps {
  title: string
  onCreate?: () => void
  createLabel?: string
}

export default function AdminPageHeader({ title, onCreate, createLabel = 'New' }: AdminPageHeaderProps) {
  return (
    <div className="flex items-center justify-between">
      <h1 className="text-2xl font-bold text-neutral-900 dark:text-white">{title}</h1>
      {onCreate && (
        <button
          type="button"
          onClick={onCreate}
          className="flex items-center gap-2 rounded-full bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-2.5 text-sm font-semibold text-white hover:from-indigo-500 hover:to-violet-500"
        >
          <FaPlus size={12} /> {createLabel}
        </button>
      )}
    </div>
  )
}
