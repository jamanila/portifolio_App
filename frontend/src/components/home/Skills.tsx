import { motion } from 'framer-motion'
import type { IconType } from 'react-icons'
import {
  SiReact,
  SiJavascript,
  SiTypescript,
  SiHtml5,
  SiCss,
  SiTailwindcss,
  SiLaravel,
  SiPhp,
  SiNodedotjs,
  SiMysql,
  SiPostgresql,
  SiGit,
  SiDocker,
  SiLinux,
  SiPostman,
  SiDigitalocean,
  SiFirebase,
} from 'react-icons/si'
import { FaAws } from 'react-icons/fa6'
import Container from '@/components/common/Container'
import SectionHeading from '@/components/common/SectionHeading'

interface Skill {
  name: string
  icon: IconType
}

const SKILL_GROUPS: { title: string; skills: Skill[] }[] = [
  {
    title: 'Frontend',
    skills: [
      { name: 'React', icon: SiReact },
      { name: 'JavaScript', icon: SiJavascript },
      { name: 'TypeScript', icon: SiTypescript },
      { name: 'HTML', icon: SiHtml5 },
      { name: 'CSS', icon: SiCss },
      { name: 'Tailwind CSS', icon: SiTailwindcss },
    ],
  },
  {
    title: 'Backend',
    skills: [
      { name: 'Laravel', icon: SiLaravel },
      { name: 'PHP', icon: SiPhp },
      { name: 'Node.js', icon: SiNodedotjs },
    ],
  },
  {
    title: 'Database',
    skills: [
      { name: 'MySQL', icon: SiMysql },
      { name: 'PostgreSQL', icon: SiPostgresql },
    ],
  },
  {
    title: 'Tools',
    skills: [
      { name: 'Git', icon: SiGit },
      { name: 'Docker', icon: SiDocker },
      { name: 'Linux', icon: SiLinux },
      { name: 'Postman', icon: SiPostman },
    ],
  },
  {
    title: 'Cloud',
    skills: [
      { name: 'AWS', icon: FaAws },
      { name: 'DigitalOcean', icon: SiDigitalocean },
      { name: 'Firebase', icon: SiFirebase },
    ],
  },
]

export default function Skills() {
  return (
    <section className="bg-neutral-50 py-20 dark:bg-neutral-900/40">
      <Container>
        <SectionHeading eyebrow="Skills" title="Technologies I work with" center />

        <div className="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-5">
          {SKILL_GROUPS.map((group, groupIndex) => (
            <motion.div
              key={group.title}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, margin: '-50px' }}
              transition={{ duration: 0.4, delay: groupIndex * 0.05 }}
              className="rounded-2xl border border-neutral-200 bg-white p-6 dark:border-neutral-800 dark:bg-neutral-900"
            >
              <h3 className="text-sm font-semibold uppercase tracking-wide text-neutral-500 dark:text-neutral-400">
                {group.title}
              </h3>
              <ul className="mt-4 space-y-3">
                {group.skills.map((skill) => (
                  <li key={skill.name} className="flex items-center gap-3 text-sm text-neutral-700 dark:text-neutral-300">
                    <skill.icon size={18} className="shrink-0 text-indigo-600 dark:text-indigo-400" />
                    {skill.name}
                  </li>
                ))}
              </ul>
            </motion.div>
          ))}
        </div>
      </Container>
    </section>
  )
}
