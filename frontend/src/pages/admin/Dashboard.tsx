import { Helmet } from 'react-helmet-async'
import { Link } from 'react-router-dom'
import { FaDiagramProject, FaBoxOpen, FaEnvelope, FaQuoteLeft } from 'react-icons/fa6'
import { useFetch } from '@/hooks/useFetch'
import { listProjects } from '@/services/projects'
import { listProducts } from '@/services/products'
import { listMessages } from '@/services/messages'
import { listTestimonials } from '@/services/testimonials'

export default function Dashboard() {
  const { data: projects } = useFetch(() => listProjects(), [])
  const { data: products } = useFetch(() => listProducts(), [])
  const { data: messages } = useFetch(() => listMessages(), [])
  const { data: testimonials } = useFetch(() => listTestimonials(), [])

  const unreadCount = messages?.filter((m) => !m.is_read).length ?? 0

  const cards = [
    { label: 'Projects', value: projects?.length ?? '—', icon: FaDiagramProject, to: '/admin/projects' },
    { label: 'Products', value: products?.length ?? '—', icon: FaBoxOpen, to: '/admin/products' },
    { label: 'Testimonials', value: testimonials?.length ?? '—', icon: FaQuoteLeft, to: '/admin/testimonials' },
    { label: 'Unread Messages', value: unreadCount, icon: FaEnvelope, to: '/admin/messages' },
  ]

  return (
    <>
      <Helmet>
        <title>Dashboard | Admin</title>
      </Helmet>

      <h1 className="text-2xl font-bold text-neutral-900 dark:text-white">Dashboard</h1>
      <p className="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Overview of your portfolio content.</p>

      <div className="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        {cards.map((card) => (
          <Link
            key={card.label}
            to={card.to}
            className="rounded-2xl border border-neutral-200 bg-white p-6 transition-shadow hover:shadow-md dark:border-neutral-800 dark:bg-neutral-900"
          >
            <card.icon size={20} className="text-indigo-600 dark:text-indigo-400" />
            <p className="mt-4 text-3xl font-bold text-neutral-900 dark:text-white">{card.value}</p>
            <p className="mt-1 text-sm text-neutral-500 dark:text-neutral-400">{card.label}</p>
          </Link>
        ))}
      </div>
    </>
  )
}
