import type { ButtonHTMLAttributes, ReactNode } from 'react'
import { Link } from 'react-router-dom'

type Variant = 'primary' | 'secondary' | 'ghost'

interface BaseProps {
  variant?: Variant
  children: ReactNode
  className?: string
}

interface ButtonAsLink extends BaseProps {
  to: string
}

interface ButtonAsButton extends BaseProps, Omit<ButtonHTMLAttributes<HTMLButtonElement>, 'children'> {
  to?: undefined
}

type ButtonProps = ButtonAsLink | ButtonAsButton

const VARIANT_CLASSES: Record<Variant, string> = {
  primary:
    'bg-gradient-to-r from-indigo-600 to-violet-600 text-white shadow-lg shadow-indigo-600/20 hover:from-indigo-500 hover:to-violet-500',
  secondary:
    'border border-neutral-300 text-neutral-900 hover:bg-neutral-100 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800',
  ghost: 'text-neutral-700 hover:bg-neutral-100 dark:text-neutral-200 dark:hover:bg-neutral-800',
}

const BASE_CLASSES =
  'inline-flex items-center justify-center gap-2 rounded-full px-6 py-3 text-sm font-semibold transition-all duration-200'

export default function Button({ variant = 'primary', children, className = '', ...props }: ButtonProps) {
  const classes = `${BASE_CLASSES} ${VARIANT_CLASSES[variant]} ${className}`

  if ('to' in props && props.to) {
    return (
      <Link to={props.to} className={classes}>
        {children}
      </Link>
    )
  }

  const buttonProps = props as ButtonHTMLAttributes<HTMLButtonElement>

  return (
    <button type="button" className={classes} {...buttonProps}>
      {children}
    </button>
  )
}
