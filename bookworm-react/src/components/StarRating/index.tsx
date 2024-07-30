import Star from './Star';
import './styles.scss';

type Props = {
    rating: number;
    onClick: (value: number) => any;
}

const StarRating = ({ rating = 0, onClick }: Props) => {
    return (
        <div className='StarRating'>
            <Star active={rating >= 1} onClick={() => onClick(1)} />
            <Star active={rating >= 2} onClick={() => onClick(2)} />
            <Star active={rating >= 3} onClick={() => onClick(3)} />
            <Star active={rating >= 4} onClick={() => onClick(4)} />
            <Star active={rating >= 5} onClick={() => onClick(5)} />
        </div>
    )
}

export default StarRating