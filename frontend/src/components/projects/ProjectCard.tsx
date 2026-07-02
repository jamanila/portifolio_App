import { motion } from 'framer-motion'
import { Link } from 'react-router-dom'
import { FaArrowUpRightFromSquare } from 'react-icons/fa6'
import type { Project } from '@/types'

export default function ProjectCard({ project }: { project: Project }) {
  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true, margin: '-50px' }}
      transition={{ duration: 0.4 }}
      className="group flex flex-col overflow-hidden rounded-2xl border border-neutral-200 bg-white transition-shadow hover:shadow-xl dark:border-neutral-800 dark:bg-neutral-900"
    >
      <div className="aspect-video overflow-hidden bg-neutral-100 dark:bg-neutral-800">
        {project.thumbnail ? (
          <img
            src={project.thumbnail}
            alt={project.title}
            loading="lazy"
            className="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
          />
        ) : (
          <div className="flex h-full w-full items-center justify-center text-neutral-400">No image</div>
        )}
      </div>

      <div className="flex flex-1 flex-col p-6">
        <h3 className="text-lg font-semibold text-neutral-900 dark:text-white">{project.title}</h3>
        <p className="mt-2 flex-1 text-sm text-neutral-600 dark:text-neutral-400">{project.short_description}</p>

        {project.technologies && project.technologies.length > 0 && (
          <div className="mt-4 flex flex-wrap gap-2">
            {project.technologies.map((tech) => (
              <span
                key={tech.id}
                className="rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-medium text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300"
              >
                {tech.name}
              </span>
            ))}
          </div>
        )}

        <div className="mt-6 flex items-center gap-4">
          <Link
            to={`/projects/${project.slug}`}
            className="text-sm font-semibold text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300"
          >
            Details
          </Link>
          {project.demo_url && (
            <a
              href={project.demo_url}
              target="_blank"
              rel="noreferrer"
              className="inline-flex items-center gap-1 text-sm font-semibold text-neutral-600 hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-white"
            >
              Demo <FaArrowUpRightFromSquare size={12} />
            </a>
          )}
          {project.is_purchasable && (
            <span className="ml-auto rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
              {project.price ? `$${project.price}` : 'Buy'}
            </span>
          )}
        </div>
      </div>
    </motion.div>
  )
}
