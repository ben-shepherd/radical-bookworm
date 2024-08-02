import './styles.scss';

type Props = {
    disabled: boolean;
    onClick: (...args: any[]) => any;
    className?: string;
    text?: string;
}

const UpdateButton = ({onClick, disabled, className = '', text = 'Update'}: Props) => {

    const handleClick = () => {
        if (disabled) {
            return;
        }

        onClick();
    }

    return (
        <button className={`UpdateButton ${disabled ? 'disabled' : ''} ${className}`} onClick={handleClick}>
            {text}
        </button>
    )
}

export default UpdateButton