import ArrowLongLeft from "components/icons/ArrowLongLeft";
import { useNavigate } from "react-router-dom";
import './styles.scss';

type Props = {
    url: string
    text: string
}

const ReturnToLink = ({ url, text }: Props) => {
    const navigate = useNavigate();

    const handleClick = (e: any) => {
        e.preventDefault()
        navigate(url)
    }

    return (
        <div className="ReturnToLink">
            <ArrowLongLeft />
            <p className="text">Return to:</p>
            <a className="link" href={url} onClick={handleClick}>{text}</a>
        </div>
    )
}

export default ReturnToLink