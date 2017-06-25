
import './style';
import * as React from 'react';

export interface TestProps {
    compiler: string,
    framework: string
}

export class Test extends React.Component<TestProps, undefined> {
    render() {
        return <h1 className="a-test">Hello from {this.props.compiler} and {this.props.framework}!</h1>;
    }
}

 