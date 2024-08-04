import { Book } from '../../types/books.t';
import GalleryItem from './GalleryItem';
import GalleryItemLoading from './GalleryItemLoading';

type Props = {
    data: Book[];
    maxItems?: number;
    loading: boolean;
    onClick?: (book: Book) => any;
}

const Gallery = ({ data, maxItems = 3, loading, onClick }: Props) => {

    const filteredItems = data.slice(0, maxItems);

    return (
        <div className="Gallery grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            {loading && (
                [...Array(maxItems)].map((_, index) => <GalleryItemLoading key={index} />)
            )}

            {filteredItems.map((item: Book) => <GalleryItem key={item.id} item={item} onClick={onClick} />)}
        </div>
    )
}

export default Gallery