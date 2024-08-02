import BookOpen from 'components/icons/BookOpen';
import Heart from 'components/icons/Heart';
import StarRating from '../StarRating';

const ListItemLoading = ({className = ''}: { className?: string }) => {

    return (
        <div className={`ListItem ListItemLoading ${className} loadingGradient`}>
            <div className="bookIcon w-9">
                <BookOpen/>
            </div>
            <div className='summary'>
                <div className="title">
                    ...
                </div>
            </div>
            <div className="ratings">
                <StarRating rating={5} onClick={() => null}/>
            </div>
            <div className="price">
                GBP
            </div>
            <div className={`favouriteIcon`}>
                <Heart/>
            </div>
        </div>
    )
}

export default ListItemLoading